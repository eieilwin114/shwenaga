<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request){
        // return $request->all();
        $role_arr = [];
        // Requirement gathering
        $user = User::with('roles')->where('mobile',$request->mobile)->first();
        // return $user;
        if($user->roles){
            foreach($user->roles as $role){
                $role_arr[$role->id] = $role->name;
            }
        }
        // return $role_arr;
        if(in_array('sales-development-representative',$role_arr)){

            $cridentials = $request->all();

                $attempt = Auth::attempt($cridentials);
            
                //Login Successful
                if($attempt){
                    $response = [
                        'success' => true,
                        'token' => Auth::user()->createToken('shwe-naga-token')->plainTextToken,
                    ];
                    return response()->json($response);
            }else{
                $response = [
                    'success' => false,
                    'message' => 'Invalid login credentials'
                ];
                return response()->json($response, 401);
            }
        }else{
           $response = [
                'success' => false,
                'message' => 'Invalid Role'
            ];
           return response()->json($response, 401);
       }
    }
}
