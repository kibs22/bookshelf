<?php

namespace App\Http\Traits;

use JWTAuth;

trait AuthenticatedUser
{
    public function user() 
    {
        return JWTAuth::parseToken()->authenticate();
    }
}