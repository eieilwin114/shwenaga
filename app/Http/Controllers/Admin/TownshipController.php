<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Township;

class TownshipController extends Controller
{
    public function index(){
        $townships = Township::with('division');
        if(session()->get(TOWNSHIP_DIVISION_FILTER)){
            $townships = $townships->where('division_id',session()->get(TOWNSHIP_DIVISION_FILTER));
        }
        $townships = $townships->get();
        $divisions = get_all_divisions();        
        return view('townships.index',compact('townships','divisions'));
    }

    public function create(){
        $divisions = get_all_divisions();
        return view('townships.create',compact('divisions'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'township' => 'required|unique:townships'
        ]);
        $inputs = $request->all();
        $inputs['created_by'] = backpack_user()->id;
        Township::create($inputs);
        return redirect()->route('township.index');
    }

    public function edit($id){
        $divisions = get_all_divisions();
        $township = Township::find($id);
        return view('townships.edit',compact('township','divisions'));
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'township' => 'required|unique:townships,township,'.$id
        ]);
        $inputs = $request->all();
        $inputs['updated_by'] = backpack_user()->id;
        $township = Township::find($id);
        if($township){
            $township->update($inputs);
        }
        return redirect()->route('township.index');
    }

    public function get_all_townships_by_div(Request $request){
        $townships = Township::where('division_id',$request->id)->get();        
        return $townships;
    }

    function search(Request $request){
        session()->start();
        session()->put(TOWNSHIP_DIVISION_FILTER, trim($request->division_id));        
        return redirect()->route('township.index');
    }

    function reset(){
        session()->forget([
            TOWNSHIP_DIVISION_FILTER
        ]);
        return redirect()->route('township.index');
    }
}
