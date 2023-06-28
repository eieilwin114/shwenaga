<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderItem;

class OrderItemController extends Controller
{
    function index(){
        $orderitems = OrderItem::selectRaw('SUM(order_items.qty) as qty, name, DATE(order_items.created_at) as date')
            ->join('orders','orders.id','=','order_items.order_id')
            ->groupBy('name', \DB::raw('DATE(created_at)'))
            // ->where('orders.sale_person_id','=',$request->user()->id)
            ->get();

        // return $orderitems;
        return view('orderitems.index',compact('orderitems'));
    }
    
}
