<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Review;
use App\Models\Transaction;
use App\Models\Transaction_List;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest;

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

        $user_id = Auth::id();
        $trans = Transaction::where('user_id', $user_id)->where('status', 'complete')->get();
        $review = false;

        if (!empty($trans)) {
            foreach ($trans as $t) {
                $bought = Transaction_List::where('transaction_id', $t->id)->where('product_id', $detail->id)->first();
                if (!empty($bought)) {
                    $review = true;
                }
            }
        }

        $data_review = Review::where('product_id', $detail->id)->orderBy('rating', 'desc')->get();

        $data = [
            'title' => 'Produk ' . $detail->name,
            'latest' => Product::orderBy('created_at', 'desc')->limit(4)->get(),
            'related' => Product::where('type', $detail->type)->orderBy('created_at', 'desc')->limit(8)->get(),
            'detail' => $detail,
            'review' => $review,
            'r_data' => $data_review,
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
            } else if ($type == 'result') {
                $data = request('search');
                if ($data) {
                    $out = "Result of '$data'";
                    $product = Product::where('name', 'LIKE', "%$data%")->paginate(9);
                }

                $filter = request('filter');
                if ($filter) {
                    $out = "Price Range '$filter'";
                    $f = explode('.', preg_replace('/[^0-9.]+/', '', $filter));
                    $product = Product::where('price', '>=', "$f[1]000")->where('price', '<=', "$f[2]000")->paginate(9);
                }
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

    public function profile()
    {
        $data = [
            'title' => 'Profile',
            'user' => Auth::user(),
        ];

        return view('user.profile', $data);
    }

    public function change_password(ChangePasswordRequest $request)
    {
        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('profile')->with('success', 'Password Updated Successfully');
    }

    public function update_profile(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->contact = $request->contact;
        $user->address = $request->address;

        if ($request->hasfile('photo')) {
            if ($user->photo != 'user.jpg') {
                $file_path = public_path() . '/files/user_images/' . $user->photo;
                unlink($file_path);
            }

            $file = $request->file('photo');
            $name = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/files/user_images/', $name);
            $user->photo = $name;
        }

        $user->save();
        return redirect()->route('profile')->with('success', 'Updated Profile Successfully');
    }

    public function store_review(Request $request)
    {
        $user_id = Auth::id();
        $review = Review::where('user_id', $user_id)->where('product_id', $request->product_id)->first();
        if (empty($review)) {
            Review::create([
                'user_id' => $user_id,
                'product_id' => $request->product_id,
                'description' => $request->comment,
                'rating' => $request->rating
            ]);
        } else {
            $review->rating = $request->rating;
            $review->description = $request->comment;
            $review->save();
        }

        return redirect()->back()->with('success', 'Review Uploaded Successfully');
    }
}
