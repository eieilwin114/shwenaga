<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Division;

class ShopController extends Controller
{
    function index(){
        $shops = Shop::all();
        $status = array(ACTIVE=>'Active',BLOCK=>'Block');
        if(session()->get(SHOP_DIVISION_FILTER)){
            $shops = $shops->where('division_id',session()->get(SHOP_DIVISION_FILTER));
        }
        if(session()->get(SHOP_TOWNSHIP_FILTER)){
            $shops = $shops->where('township_id',session()->get(SHOP_TOWNSHIP_FILTER));
        }
        $divisions = get_all_divisions();
        $townships = get_all_townships(session()->get(SHOP_DIVISION_FILTER));
        return view('shops.index',compact('shops','divisions','status','townships'));
    }
    
    function create(){        
        $divisions = get_all_divisions();
        $townships = get_all_townships();
        return view('shops.create',compact('divisions','townships'));
    }

    function store(Request $request){
        $this->validate($request,[
            'name' => 'required|unique:shops'
        ]);   
        $input = $request->all();
        $input['created_by'] = backpack_user()->id;
        Shop::create($input);
        return redirect()->route('shop.index');
    }

    function edit($id){ 
        $divisions = get_all_divisions();
        $townships = get_all_townships();
        $status = array(ACTIVE=>'Active',BLOCK=>'Block');    
        $shop = Shop::find($id);
        return view('shops.edit',compact('shop','divisions','townships','status'));
    }

    function update(Request $request, $id){
        $this->validate($request,[
            'name' => 'required|unique:shops,name,'.$id
        ]);
        $input = $request->all();
        $input['updated_by'] = backpack_user()->id;
        $Shop = Shop::find($id);
        $Shop->update($input);
        return redirect()->route('shop.index');
    }

    function search(Request $request){
        session()->start();
        session()->put(SHOP_DIVISION_FILTER, trim($request->division_id));
        session()->put(SHOP_TOWNSHIP_FILTER, trim($request->township_id));
        return redirect()->route('shop.index');
    }

    function reset(){
        session()->forget([
            SHOP_DIVISION_FILTER,
            SHOP_TOWNSHIP_FILTER,
        ]);
        return redirect()->route('shop.index');
    }

    function shops_by_division(Request $request){
        $shops = Shop::where('division_id',$request->id);
        $shops = $shops->get();
            
        return $shops;
    }
}
