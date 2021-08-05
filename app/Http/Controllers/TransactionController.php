<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Transaction_List;
use App\Models\Chart;
use App\Http\Requests\TransactionRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Transaksi',
            'transaction' => Transaction::all(),
        ];

        return view('admin.transaction.transaction-list', $data);
    }

    public function admin_show($id)
    {
        $order = Transaction::find($id);
        if (!$order) abort(404, 'Not Data Found');

        $data = [
            'title' => "Lihat Detail Transaksi",
            'order' => $order,
        ];

        return view('admin.transaction.transaction-detail', $data);
    }

    public function update_status(Request $request, $type)
    {
        $order = Transaction::find($request->id);
        $order->status = $type;
        $order->save();
        return redirect()->back()->with('success', 'Status Updated');
    }

    public function show()
    {
        $user_id = Auth::id();
        $data = [
            'title' => 'Order History',
            'transaction' => Transaction::where('user_id', $user_id)->get(),
        ];

        return view('user.order', $data);
    }

    public function store(TransactionRequest $request)
    {
        $id = Auth::id();

        $order = Transaction::create([
            'user_id' => $id,
            'amount' => $request->total,
            'address' => $request->address,
            'shipment' => $request->shipment,
            'contact' => $request->contact
        ]);

        $order->order_id = Str::random(4) . '-' . explode('-', $order->id)[0];

        $order->save();

        for ($i = 0; $i < sizeof($request->product_id); $i++) {
            Transaction_List::create([
                'transaction_id' => $order->id,
                'product_id' => $request->product_id[$i],
                'name' => $request->product_name[$i],
                'qty' => $request->product_qty[$i],
                'price' => $request->product_price[$i],
            ]);

            $cart = Chart::where('user_id', $id)->where('product_id', $request->product_id[$i])->first();
            $cart->delete();
        }

        $midtrans = $this->midtrans_store($order);
        $order->va = $midtrans->va_numbers[0]->va_number;
        $order->save();

        return redirect()->route('order')->with('success', 'Checkout Successfull');
    }

    public function midtrans_store(Transaction $order)
    {
        $server_key = base64_encode(config('app.midtrans.server_key'));
        $base_uri = config('app.midtrans.base_uri');

        $client = new Client([
            'base_uri' => $base_uri
        ]);

        $header = [
            'Accept' => 'application/json',
            'Authorization' => 'Basic ' . $server_key,
            'Content-Type' => 'application/json'
        ];

        $body = [
            "payment_type" => "bank_transfer",
            "transaction_details" => [
                "order_id" => $order->order_id,
                "gross_amount" => $order->amount
            ],
            "bank_transfer" => [
                "bank" => "bni"
            ],
        ];


        $res = $client->post('/v2/charge', [
            'headers' => $header,
            'body' => json_encode($body)
        ]);

        return json_decode($res->getBody());
    }

    public function detail($id)
    {
        $transaction = Transaction::where('order_id', $id)->where('user_id', Auth::id())->first();

        if (!$transaction) return abort(404);

        $data = [
            'title' => 'Order Detail',
            'order' => $transaction,
        ];

        return view('user.detail-order', $data);
    }

    public function update_payment(Request $request)
    {
        $payload = $request->getContent();
        $notif = json_decode($payload);

        $order = Transaction::where('order_id', $notif->order_id)->first();
        $order->status = $notif->transaction_status;
        $order->save();

        foreach ($order->list as $l) {
            $p = Product::find($l->product_id);
            $p->stock = $p->stock - $p->qty;
            $p->save();
        }

        $res = [
            'code' => 200,
            'message' => "Success",
        ];

        return response($res, 200);
    }
}
