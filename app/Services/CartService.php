<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Product;
use Cart;
use Arr;
use Auth;

class CartService
{
    public static function cartItem()
    {
        Cart::restore(request()->user()->id);
        Cart::store(request()->user()->id);
        $cardItems = Cart::content();
        // Associate array to numeratic array
        $cardItems2 = [];
        foreach($cardItems as $cardItem){
            $cardItems2[] = $cardItem;
        }
        return $cardItems2;
    }
}