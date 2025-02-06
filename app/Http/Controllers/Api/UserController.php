<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user=User::orderByDesc('id')->paginate(5);
        return view('apiUser', compact('user'));
    }

    /*     public function createuser(Request $request)
    {
        return response()->json(['message' => 'Endpoint is working!']);
    } */



    public function createuser(CreateUserRequest $request)
    {


        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        return response()->json([
            'status'    => true,
            'message'   => 'User created successfully',
            'redirect'  => route('apiUser'),
            'data'      => $user
        ]);
    }


    public function login(LoginUserRequest $request)
    {
        $user=Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        if(!$user){
            return response()->json([
                'status'    => false,
                'message'   => 'Giriş uğursuzdur',
                'data'      => Auth::user()
            ]);
        }
        return response()->json([
            'status'    => true,
            'message'   => 'Giriş uğurludur',
            'data'      => Auth::user()
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status'    => true,
            'message'   => 'Çıxış uğurludur'

        ]);
    }










    }

