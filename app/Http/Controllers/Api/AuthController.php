<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        // Requirement gathering
        $cridentials = $request->all();
        // Attempt login
        $attempt = Auth::attempt($cridentials);
        //Login Successful
        if($attempt){
            $response = [
                'success' => true,
                'token' => Auth::user()->createToken('shwe-naga-token')->plainTextToken,
            ];
            return response()->json($response);
       }
       //Login Fail
       else{
           $response = [
                'success' => false,
                'message' => 'Invalid login credentials'
            ];
           return response()->json($response, 401);
       }
    }
}
