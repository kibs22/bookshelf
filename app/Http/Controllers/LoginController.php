<?php

namespace App\Http\Controllers;

use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;



class LoginController extends Controller
{
    public function authenticate(LoginRequest $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error_credentials' => 'Wrong username or password'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        $user = \App\User::whereEmail($credentials['email'])->first();
        if($user->id){

            if($user->blocked_at == NULL) {
                return response()->json(compact('user','token'))->header('Authorization', "Bearer {$token}");
            }
            
            return response()->json(['error' => 'Your account is temporarily suspend'], 401);
       
           
        }else{
            return response()->json(['err' => 'Wrong username or password']);
        }
        
    }

    public function getUsers(){

        return response()->json([
            [
                'name' => 'adrian'
            ],
            [
                'name' => 'zester'
            ]

        ]);
    }
}
