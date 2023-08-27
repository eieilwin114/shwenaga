<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controllsearcher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use DB;

class UserController extends Controller
{
    function index(){
        $divisions = get_all_divisions();        
        $users = User::select('users.*','shops.name as shop_name','divisions.division')->join('shops','users.shop_id','=','shops.id')
        ->join('divisions','divisions.id','=','shops.division_id')
        ->with('roles');        
        if(session()->get(USER_DIVISION_FILTER)){
            $users = $users->where('division_id',session()->get(USER_DIVISION_FILTER));
        }
        $users = $users->get();
        return view('users.index',compact('users','divisions'));
    }

    function create(){
        $roles = Role::pluck('name','name')->all();
        $shops = get_all_shops();
        return view('users.create',compact('roles','shops'));
    }

    function store(UserRequest $request){
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('role'));    
        return redirect()->route('users')
                ->with('success','User created successfully');
    }

    function edit($id){
        $user = User::find($id);
        $shops = get_all_shops();
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('users.edit',compact('user','roles','userRole','shops'));
    }

    function update(Request $request,$id){  
        $this->validate($request, [
            'name' => 'required',
            'mobile' => 'required|unique:users,mobile,'.$id,
            'password' => 'same:confirm-password',
            'role' => 'required'
        ]);
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();    
        $user->assignRole($request->input('role'));
        return redirect()->route('users')->with('success','User updated successfully');
    }

    function search(Request $request){
        session()->start();
        session()->put(USER_DIVISION_FILTER, trim($request->division_id));
        return redirect()->route('users');
    }

    function reset(){
        session()->forget([
            USER_DIVISION_FILTER
        ]);
        return redirect()->route('users');
    }

    function destroy($id){
        return User::find($id)->delete();
    }

    function user_by_shop(Request $request){
        $users = User::where('shop_id',$request->id);
        if(!backpack_user()->hasRole('admin')){
            $users = $users->where('shop_id',backpack_user()->shop_id);
        }
        $users = $users->get();
        return $users;
    }
}