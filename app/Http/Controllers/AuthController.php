<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request  $request)
    {
        $data = $request->validate([
            'name' => 'requires|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = User::create($data);

        return response()->json([
            'success'=>true,
            'data'=>['token'=>$user->createToken('api')->plainTextToken]
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json(['success'=>false, 'message'=>'Invalid credentials'], 401);
        }

        return response()->json([
            'success' => true,
            'data'=>['token'=>$request->user()->createToken('api')->plainTextToken]
        ]);
    }
}
