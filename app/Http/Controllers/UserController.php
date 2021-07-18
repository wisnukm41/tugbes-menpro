<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Chart;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Home',
            'latest' => Product::orderBy('created_at', 'desc')->limit(8)->get(),
            'p_raw' => Product::where('type', 'Bahan Dasar')->orderBy('name')->get(),
            'p_fin' => Product::where('type', 'Siap Konsumsi')->orderBy('name')->get(),
            'p_ext' => Product::where('type', 'Tambahan')->orderBy('name')->get(),
        ];

        return view('user.home', $data);
    }

    public function detail($id)
    {
        $detail = Product::find($id);
        if (!$detail) abort(404, 'Not Data Found');
        $data = [
            'title' => 'Produk ' . $detail->name,
            'latest' => Product::orderBy('created_at', 'desc')->limit(4)->get(),
            'related' => Product::where('type', $detail->type)->orderBy('created_at', 'desc')->limit(8)->get(),
            'detail' => $detail,
        ];
        return view('user.detail', $data);
    }

    public function shop($type = "")
    {
        $out = "";
        if ($type) {
            if ($type == 'raw' || $type == 'ready' || $type == 'extra') {
                if ($type == 'raw') {
                    $type = 'Bahan Dasar';
                    $out = "Raw Ingredient";
                }
                if ($type == 'ready') {
                    $type = 'Siap Konsumsi';
                    $out = "Ready To Consume";
                }
                if ($type == 'extra') {
                    $type = 'Tambahan';
                    $out = "Extra";
                }
                $product = Product::where('type', $type)->orderBy('name', 'asc')->paginate(9);
            } else {
                abort(404, 'Not Data Found');
            }
        } else {
            $product = Product::orderBy('name', 'asc')->paginate(9);
        }

        $data = [
            'title' => 'Baso Builder Shop ',
            'latest' => Product::orderBy('created_at', 'desc')->limit(4)->get(),
            'products' => $product,
            'type' => $out
        ];
        return view('user.shop', $data);
    }

    public function chart()
    {
        $data = [
            'title' => 'Cart',
            'products' => Chart::where('user_id', Auth::id())->orderBy('created_at')->get()
        ];
        return view('user.cart', $data);
    }

    public function add_chart(Request $request)
    {
        $product_id = request('id');
        $qty = request('product-quatity');
        $user_id = Auth::id();
        $stock = Product::find($product_id)->stock;


        $data = Chart::where('product_id', $product_id)->where('user_id', $user_id)->first();
        if ($data) {
            if (($data->qty + $qty) > $stock) return redirect()->back()->with('error', 'Cart Quantity exceed Stock');
            $data->qty = $data->qty + $qty;
            $data->save();
        } else {
            Chart::create([
                'product_id' => $product_id,
                'user_id' => $user_id,
                'qty' => $qty
            ]);
        }

        return redirect()->back()->with('success', 'Product Added to Chart');
    }
}
