<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        $register = Validator::make($request->all(),[
            'name'=>'required|string',
            'password'=>'required|min:0',
            'email'=>'required|string',
            'role'=>'required|in:visitor,service_officer,admin'
        ]);

        if($register->fails()){
            return response()->json(['errors'=>$register->errors()],403);
        }

        $valid = $register->validated();

        $user= User::create([
            'name'=>$valid['name'],
            'email'=>$valid['email'],
            'password'=>Hash::make($valid['password']),
            'role'=>$valid['role']
        ]);

        return response()->json(['message'=>'user created successfully',

        'user'=>$user
        
        ],201);
    }

    public function login(Request $request){
        $login = Validator::make($request->all(), [
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:6'

        ]);

        if($login->fails()){
            return response()->json(['errors'=>$login->errors()],403);
        }

        $vars = $login->validated();

        $user = User::where('email', $vars['email'])->first();

        if(!$user || !Hash::check($vars['password'],$user->password) ){
            return response()->json(['errors'=>'invalid'], 403);
        }

        $token = $user->createToken('auth')->plainTextToken;
        return response()->json(['message'=>'logged in successfully',
         'user'=>$user,
         'token'=>$token
        
        ], 200);


    

        





        
    }
}
