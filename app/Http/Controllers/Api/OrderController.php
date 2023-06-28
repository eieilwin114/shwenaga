<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Cart;
use Auth;

class OrderController extends Controller
{

    public function index(Request $request){

        if( $request->has('items-only')){
            $orders = Order::
                        where('sale_person_id','=',$request->user()->id)
                        ->paginate();
            // Set orders
            $orders = $orders->toArray();
            $orders = collect($orders);
            // Filter Data Items
            $dataItems = $orders['data'];
            $dataItems = collect($dataItems);
            $dataItems = $dataItems->map(function ($dataItem){
                return $dataItem['items'];
            });
            $orders['data'] = $dataItems;
            return $orders;
        }


        // Only orders from login users
        // if($request->route()->getName()=='user.orders'){
        //     return Order::with('items')
        //                 // ->where('sale_person_id','=',$request->user()->id)
        //                 ->paginate();
        // }

        if($request->route()->getName() == 'user.orders'){
            $orderitems = OrderItem::selectRaw('SUM(order_items.qty) as qty, name, DATE(order_items.created_at) as date')
            ->join('orders','orders.id','=','order_items.order_id')
            ->groupBy('name', \DB::raw('DATE(created_at)'))
            ->where('orders.sale_person_id','=',$request->user()->id)
            ->get();

            $result = [];
            $result['status'] = 'ok';
            $result['data'] = $orderitems;

            return $result;
        }

        // Return all orders
        return Order::with('items')->paginate();
    }


    public function indexOrderItem(Request $request){
        return OrderItem::paginate();
    }

    public function store(Request $request){
        // Cart restore
        Cart::restore($request->user()->id);
        // Return Error if 
        if(Cart::count()==0){
            return response(['message'=>"Empty card item."],400);
        }
        // Create Order
        $order = Order::create([
            'sale_person_id'    => $request->user()->id,
            'shop_owner_id'     => ($request->user()->shop_owner_id==null)?0:$request->user()->shop_owner_id,
            'status'            => 'created',
        ]);

        $cardItems = Cart::content();
        Cart::destroy();

        $createdItems = [];
        foreach($cardItems as $cardItem){
            $item = Product::find($cardItem->id)->toArray();
            $item['order_id'] = $order->id;
            $item['qty'] = $cardItem->qty;
            $createdItems[] = OrderItem::create($item);
        }
        // Get order
        $order = Order::with('items')->find($order->id);
        // Return
        return [
            'status'        => 'ok',
            'order'         => $order,
            // 'created_items' => $createdItems,
            // 'card_items'    => $cardItems,
        ];
    }
}
