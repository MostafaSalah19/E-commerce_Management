<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
