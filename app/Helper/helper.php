<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Chart;
use App\Models\Product;
use App\Models\Wishlist;

if (!function_exists('wishlist_count')) {
  function wishlist_count()
  {
    return Wishlist::where('user_id', Auth::id())->count();
  }
}

if (!function_exists('cart_count')) {
  function cart_count()
  {
    return Chart::where('user_id', Auth::id())->sum('qty');
  }
}

if (!function_exists('check_wishlist')) {
  function check_wishlist($id)
  {
    return Wishlist::where('user_id', Auth::id())->where('product_id', $id)->count() > 0;
  }
}
