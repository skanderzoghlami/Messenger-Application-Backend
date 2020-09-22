<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function register(storeUserRequest $request)
    {
     $user = User::Create([
    'name'=>$request['name'],
    'email'=>$request['email'],
    'password'=>Hash::make($request['password']),
    ]);
    return new UserResource($user);
    }
}
