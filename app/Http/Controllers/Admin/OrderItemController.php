<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Exports\SaleReportExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ShopSaleReportExport;

class OrderItemController extends Controller
{
    function index(){
        // $orderitems = OrderItem::selectRaw('users.name as sale_person,users.mobile as mobile,SUM(order_items.qty) as qty, order_items.name, DATE(order_items.created_at) as date')
        //     ->join('orders','orders.id','=','order_items.order_id')
        //     ->leftjoin('users','users.sale_person_ids','=','orders.sale_person_id')
        //     ->groupBy('order_items.name', \DB::raw('DATE(created_at)'),'users.name','users.mobile')
        //     ->get();
        $from_date_filter = session()->get(SR_FROMDATE_FILTER);
        $to_date_filter = session()->get(SR_TODATE_FILTER);
        $division_filter = session()->get(SR_DIVISION_FILTER);
        $name_filter = session()->get(SR_NAME_FILTER);

        $divisions = get_all_divisions();

        $orderitems = OrderItem::selectRaw('users.name as sale_person,users.mobile as mobile,SUM(order_items.qty) as qty, order_items.name, DATE(order_items.created_at) as date, shops.name as shop_name, divisions.division')
            ->leftjoin('orders','orders.id','=','order_items.order_id')
            ->leftjoin('users','users.id','=','orders.sale_person_id')
            ->leftjoin('shops', 'shops.id', '=', 'users.shop_id')
            ->leftjoin('divisions', 'divisions.id', '=', 'shops.division_id');
            
        if(backpack_user()->hasRole('shop-admin')){
            $orderitems = $orderitems->where('users.shop_id','=', backpack_user()->shop_id);
        }
            
        if($from_date_filter){
            $orderitems = $orderitems->where(\DB::raw('DATE(order_items.created_at)'),'>=',$from_date_filter);
        }

        if($to_date_filter){
            $orderitems = $orderitems->where(\DB::raw('DATE(order_items.created_at)'),'<=',$to_date_filter);
        }

        if($division_filter){
            $orderitems = $orderitems->where('division_id',$division_filter);
        }

        if($name_filter){
            $orderitems = $orderitems->where('users.name','like','%'.$name_filter.'%');
        }

        $orderitems = $orderitems->groupBy('order_items.name', \DB::raw('DATE(order_items.created_at)'),'users.name','users.mobile', 'shops.name', 'divisions.division')->get();
        // return $orderitems;
        return view('orderitems.index',compact('orderitems','divisions'));
    }

    function search(Request $request){
        session()->start();
        session()->put(SR_FROMDATE_FILTER, trim($request->from_date));
        session()->put(SR_TODATE_FILTER, trim($request->to_date));
        session()->put(SR_DIVISION_FILTER, trim($request->division_id));
        session()->put(SR_NAME_FILTER, trim($request->name));
        return redirect()->route('order-item.index');
    }

    function reset(){
        session()->forget([
            SR_FROMDATE_FILTER,
            SR_TODATE_FILTER,
            SR_DIVISION_FILTER,
            SR_NAME_FILTER,
        ]);
        return redirect()->route('order-item.index');
    }

    function shop(){
        $from_date_filter = session()->get(SH_FROMDATE_FILTER);
        $to_date_filter = session()->get(SH_TODATE_FILTER);
        $division_filter = session()->get(SH_DIVISION_FILTER);
        $shop_filter = session()->get(SH_SHOP_FILTER);

        $divisions = get_all_divisions();
        $shops = get_all_shops();
        // return $from_date_filter;

        $orderitems = OrderItem::selectRaw('shops.id, shops.name as shop_name, SUM(order_items.qty) as qty, order_items.name, DATE(order_items.created_at) as date,division')
            ->join('orders','orders.id','=','order_items.order_id')
            ->leftjoin('users','users.id','=','orders.sale_person_id')
            ->leftjoin('shops', 'shops.id', '=', 'users.shop_id')
            ->leftjoin('divisions','divisions.id','=','shops.division_id');

        if($from_date_filter){
            $orderitems = $orderitems->where(\DB::raw('DATE(order_items.created_at)'),'>=',$from_date_filter);
        }

        if($to_date_filter){
            $orderitems = $orderitems->where(\DB::raw('DATE(order_items.created_at)'),'<=',$to_date_filter);
        }

        if($division_filter){
            $orderitems = $orderitems->where('division_id',$division_filter);
        }

        if($shop_filter){
            $orderitems = $orderitems->where('shop_id',$shop_filter);
        }

        $orderitems = $orderitems->groupBy('order_items.name', \DB::raw('DATE(order_items.created_at)'),'shops.id', 'shops.name','division')->get();
        // return $orderitems;
        return view('orderitems.shopindex',compact('orderitems','divisions','shops'));
    }

    function shopsearch(Request $request)
    {
        session()->start();
        session()->put(SH_FROMDATE_FILTER, trim($request->from_date));
        session()->put(SH_TODATE_FILTER, trim($request->to_date));
        session()->put(SH_DIVISION_FILTER, trim($request->division_id));
        session()->put(SH_SHOP_FILTER, trim($request->shop_id));
        return redirect()->route('order-item-shop');
    }

    function shopreset()
    {
        session()->forget([
            SH_FROMDATE_FILTER,
            SH_TODATE_FILTER,
            SH_DIVISION_FILTER,
            SH_SHOP_FILTER
        ]);
        return redirect()->route('order-item-shop');
    }


    function salePersonExport(){
        $from_date_filter = session()->get(SR_FROMDATE_FILTER);
        $to_date_filter = session()->get(SR_TODATE_FILTER);
        $division_filter = session()->get(SR_DIVISION_FILTER);
        $name_filter = session()->get(SR_NAME_FILTER);
        
        $orderitems = OrderItem::selectRaw('users.name as sale_person,users.mobile as mobile,SUM(order_items.qty) as qty, order_items.name, DATE(order_items.created_at) as date, shops.name as shop_name, divisions.division')
            ->leftjoin('orders','orders.id','=','order_items.order_id')
            ->leftjoin('users','users.id','=','orders.sale_person_id')
            ->leftjoin('shops', 'shops.id', '=', 'users.shop_id')
            ->leftjoin('divisions', 'divisions.id', '=', 'shops.division_id');
            
        if(backpack_user()->hasRole('shop-admin')){
            $orderitems = $orderitems->where('users.shop_id','=', backpack_user()->shop_id);
        }
            
        if($from_date_filter){
            $orderitems = $orderitems->where(\DB::raw('DATE(order_items.created_at)'),'>=',$from_date_filter);
        }

        if($to_date_filter){
            $orderitems = $orderitems->where(\DB::raw('DATE(order_items.created_at)'),'<=',$to_date_filter);
        }

        if($division_filter){
            $orderitems = $orderitems->where('division_id',$division_filter);
        }

        if($name_filter){
            $orderitems = $orderitems->where('users.name','like','%'.$name_filter.'%');
        }

        $orderitems = $orderitems->groupBy('order_items.name', \DB::raw('DATE(order_items.created_at)'),'users.name','users.mobile', 'shops.name', 'divisions.division')->get();

        return Excel::download(new SaleReportExport($orderitems), 'sale-person.xlsx');
    }

    function shopExport(){
        $from_date_filter = session()->get(SH_FROMDATE_FILTER);
        $to_date_filter = session()->get(SH_TODATE_FILTER);
        $division_filter = session()->get(SH_DIVISION_FILTER);
        $shop_filter = session()->get(SH_SHOP_FILTER);

        $orderitems = OrderItem::selectRaw('shops.id, shops.name as shop_name, SUM(order_items.qty) as qty, order_items.name, DATE(order_items.created_at) as date,division')
            ->join('orders','orders.id','=','order_items.order_id')
            ->leftjoin('users','users.id','=','orders.sale_person_id')
            ->leftjoin('shops', 'shops.id', '=', 'users.shop_id')
            ->leftjoin('divisions','divisions.id','=','shops.division_id');

        if($from_date_filter){
            $orderitems = $orderitems->where(\DB::raw('DATE(order_items.created_at)'),'>=',$from_date_filter);
        }

        if($to_date_filter){
            $orderitems = $orderitems->where(\DB::raw('DATE(order_items.created_at)'),'<=',$to_date_filter);
        }

        if($division_filter){
            $orderitems = $orderitems->where('division_id',$division_filter);
        }

        if($shop_filter){
            $orderitems = $orderitems->where('shop_id',$shop_filter);
        }

        $orderitems = $orderitems->groupBy('order_items.name', \DB::raw('DATE(order_items.created_at)'),'shops.id', 'shops.name','division')->get();

        return Excel::download(new ShopSaleReportExport($orderitems), 'shop-sale.xlsx');
    }

    function orders(){
        $orders = Order::with('saleperson');
        if(session()->get(ORDER_FROMDATE_FILTER)){
            $orders = $orders->whereDate('created_at','>=',session()->get(ORDER_FROMDATE_FILTER));
        }
        if(session()->get(ORDER_TODATE_FILTER)){
            $orders = $orders->whereDate('created_at','<=',session()->get(ORDER_TODATE_FILTER));
        }
        if(session()->get(ORDER_NAME_FILTER)){
            $orders = $orders->whereHas('saleperson', function ($query) {
                $query->where('name','like','%'.session()->get(ORDER_NAME_FILTER) .'%');
            });
        }
        $orders = $orders->get();
        return view('orders.index',compact('orders'));
    }

    function order_view($id){
        $order = Order::with('items')->find($id);
        return view('orders.edit',compact('order'));
    }

    function order_item_edit($id){
        $orderitem = OrderItem::find($id);
        return view('orders.orderitemedit',compact('orderitem'));
    }

    function order_item_update(Request $request,$id){
        $orderitem = OrderItem::find($id);
        $input = $request->all();
        $orderitem->update($input);
        return redirect()->route('orders');
    }

    function order_search(Request $request)
    {
        session()->start();
        session()->put(ORDER_FROMDATE_FILTER, trim($request->from_date));
        session()->put(ORDER_TODATE_FILTER, trim($request->to_date));
        session()->put(ORDER_NAME_FILTER, trim($request->name));
        return redirect()->route('orders');
    }

    function order_reset()
    {
        session()->forget([
            ORDER_FROMDATE_FILTER,
            ORDER_TODATE_FILTER,
            ORDER_NAME_FILTER,
        ]);
        return redirect()->route('orders');
    }
}
