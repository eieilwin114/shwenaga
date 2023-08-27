<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DivisionRequest;
use App\Models\Division;

class DivisionController extends Controller
{
    function index(){
        $divisions = Division::all();
        return view('divisions.index',compact('divisions'));
    }
    
    function create(){
        return view('divisions.create');
    }

    function store(DivisionRequest $request){        
        $input = $request->all();
        $input['created_by'] = backpack_user()->id;
        Division::create($input);
        return redirect()->route('division.index');
    }

    function edit($id){        
        $division = Division::find($id);
        return view('divisions.edit',compact('division'));
    }

    function update(Request $request, $id){
        $this->validate($request,[
            'division' => 'required|unique:divisions,division,'.$id
        ]);
        $input = $request->all();
        $input['updated_by'] = backpack_user()->id;
        $division = Division::find($id);
        $division->update($input);
        return redirect()->route('division.index');
    }
}
