<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Product;
use Cart;
use Arr;
use Auth;
use App\Services\CartService;



class CartController extends Controller
{


    public function index(CartService $cartService){
        return [
            'status' => 'ok',
            'cart_items' => $cartService->cartItem(),
            'total_qty' => Cart::count()
        ];
    }


    
    public function store(Request $request){
        // Information gathering
        $items = $request->all();
        // Add price to items
        $items2 = [];
        foreach($items as $key => $val){
            $val['price'] = 1;
            $items2[] = $val;
        }
        // Remove item if qty is 0
        $items3 = array_filter($items2, function($item){
            return $item['qty'] != 0;
        });
        // Cart store
        Cart::restore($request->user()->id);
        Cart::destroy();
        Cart::add($items3);
        Cart::store($request->user()->id);
        // Associate array to numeratic array
        $cardItems = Cart::content();
        $cardItems2 = [];
        foreach($cardItems as $cardItem){
            $cardItems2[] = $cardItem;
        }
        // Return value
        return [
            'status' => 'ok',
            'cart_items' => $cardItems2,
            'total_qty' => Cart::count()
        ];
    }



    public function create(Request $request){
        // Information gathering
        $item = $request->all();
        $item['price'] = 1;
        Cart::restore($request->user()->id);
        if($item['qty']!==0){
            Cart::add([$item]);
        }
        Cart::store($request->user()->id);
        // Associate array to numeratic array
        $cardItems = Cart::content();
        $cardItems2 = [];
        foreach($cardItems as $cardItem){
            $cardItems2[] = $cardItem;
        }
        // Order Create
        // Return value
        return [
            'status' => 'ok',
            'cart_items' => $cardItems2,
            'total_qty' => Cart::count()
        ];
    }
}
