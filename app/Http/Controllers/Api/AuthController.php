<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $validate = Validator::make($request->all(),
            [
                'email' => 'required|email|max:255',
                'password' => 'required|string|min:3|max:255'
            ]);
        if ($validate->fails()) {
            return response()->json([
                'message' => 'All fields are mandetory',
                'error' => $validate->messages(),
            ], 422);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message'=>'The provided credantials are incorrect'],401);
        }
        $token=$user->createToken($user->name.'Auth-Token')->plainTextToken;
        return response()->json(
            [
                'message'=>'Login Successful',
                'token_type'=>'Bearer',
                'token'=>$token
            ],200);
    }

    public function register(Request $request): JsonResponse
    {
        $validate=Validator::make($request->all(),
        [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:3|max:255'
        ]);
        if ($validate->fails()) {
            return response()->json([
                'message' => 'All fields are mandetory',
                'error' => $validate->messages(),
            ], 422);
        }
        $user=User::create(
            [
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password)
            ]
        );

        if ($user)
        {
            $token=$user->createToken($user->name.'Auth-Token')->plainTextToken;
            return response()->json(
                [
                    'message'=>'Registration Successful',
                    'token_type'=>'Bearer',
                    'token'=>$token
                ],201);
        }else
        {
            return response()->json(['message'=>'Something want wrong! while registration'],500);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        //return'dsas';
        $user=User::where('id',$request->user()->id)->first();
        if ($user)
        {
            $user->tokens()->delete();
            return response()->json(['message'=>'Logged out Successful'],200);
        }else{
            return response()->json(['message'=>'User Not Found'],404);
        }
    }
    public function profile(Request $request): JsonResponse
    {
        if ($request->user())
        {
            return response()->json(
                [
                    'message'=>'Profile Fetched',
                    'data'=>$request->user()
                ],200);

        }else{
            return response()->json(['message'=>'Not Authenticated'],401);

        }
    }

}
