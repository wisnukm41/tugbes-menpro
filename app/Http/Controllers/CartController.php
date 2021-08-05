<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Chart;
use App\Models\Wishlist;

class CartController extends Controller
{
    public function chart()
    {
        $data = [
            'title' => 'Cart',
            'products' => Chart::where('user_id', Auth::id())->orderBy('created_at')->get(),
            'random' => Product::all()->random(8),
            'total' => 0,
            'subtotal' => 0,
            'user' => Auth::user(),
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

        if (request('wh')) {
            Wishlist::where('user_id', $user_id)->where('product_id', $product_id)->delete();
        }

        return redirect()->back()->with('success', 'Product Added to Chart');
    }

    public function destroy_one($id)
    {
        Chart::find($id)->delete();
        return redirect()->back()->with('success', 'Product Removed From Cart');
    }

    public function destroy()
    {
        Chart::where('user_id', Auth::id())->delete();
        return redirect()->back()->with('success', 'All Product Removed From Cart');
    }
}
