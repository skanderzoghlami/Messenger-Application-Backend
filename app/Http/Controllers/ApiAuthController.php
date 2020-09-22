<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
       try{
            $http = new \GuzzleHttp\Client;
            $response = $http->post('http://localhost:81/chatapp/public/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => '3',
                    'client_secret' => 'JX4m4kXGnLK2FOlGfbMFPnZr9eKPfVzwHoThxNgu',
                    'username' => $request->email,
                    'password' =>$request->password,
                    'scope' =>''
                ],
            ]);

            return $response->getBody();

        }
       catch (\GuzzleHttp\Exception\BadResponseException $e) {
           if ($e->getCode() == 401) {
               return response()->json(['message' => 'This action can\'t be perfomed at this time. Please try later.'], $e->getCode());
           } else if ($e->getCode() == 400) {
               dd($e);
               return response()->json(['message' => 'These credentials do not match our records.'], $e->getCode());
           }

           return response()->json('Something went wrong on the server. Please try later.', $e->getCode());
       }

    }
    public function logout()
    {
        return auth()->user()->tokens;
        return auth()->user()->tokens->each(function ($token)
       {
           $token->delete();
       });
    return response()->json('logout successfully',200);
    }
}
