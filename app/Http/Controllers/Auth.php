<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Auth extends Controller
{
    public function register(Request $request){

        $validator=Validator::make($request->all(),[
               "name"=>"required",
            "email"=>"required|unique:users|email",
            "password"=>"required"
        ]);

        if($validator->fails()){
            return response()->json([
                "success"=>"false",
                "error"=>$validator->errors(),
            ]);
        }

        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();

        $token = $user->createToken('create_token')->plainTextToken;
        return response()->json([
            "success"=>"true",
            "token"=>$token,
            "message"=>"registered sucessfully"
        ]);

    }

    public function login(Request $request){

        $validator=Validator::make($request->all(),([
            "email"=>"required|email",
            "password"=>"required",
        ]));
   
        if($validator->fails()){
            return response()->json([
                "success"=>"false",
                "error"=>$validator->errors(),
            ]);
        }

        $user=user::where('email',$request->email)->first();
        if(!$user || !hash::check($request->password,$user->password)){
            return response()->json([
                "success"=>"false",
                "null"=>null,
                "message"=>"invalid crendentials"
            ]);
        }
        $token = $user->createToken('create_token')->plainTextToken;
        return response()->json([
            "success"=>"true",
            "token"=>$token,
            "message"=>"loggedin sucessfully"
        ]);
    }

    public function logout(){
        $user=User::find(FacadesAuth::user()->id);
        $user->tokens()->delete();
       return response()->json([
            "success"=>"true",
            "message"=>"logouted sucessfully",
        ]);
    }
}

