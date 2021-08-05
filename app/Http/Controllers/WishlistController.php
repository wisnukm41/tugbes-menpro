<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\Product;

class WishlistController extends Controller
{
    public function wishlist()
    {
        $data = [
            'title' => 'Wishlist',
            'products' => Wishlist::where('user_id', Auth::id())->orderBy('created_at')->get(),
            'random' => Product::all()->random(8),
        ];
        return view('user.wishlist', $data);
    }

    public function add_wishlist($id)
    {
        $user_id = Auth::id();
        Wishlist::create([
            'user_id' => $user_id,
            'product_id' => $id
        ]);

        return redirect()->back()->with('success', 'Product Added to Wishlist');
    }

    public function destroy_one($id)
    {
        Wishlist::find($id)->delete();
        return redirect()->back()->with('success', 'Product Removed From Wishlist');
    }
}
