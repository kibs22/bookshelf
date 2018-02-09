<?php

namespace App\Http\Controllers;

use JWTAuth;
use DateHelper;
use Illuminate\Http\Request;
use App\Http\Traits\AuthenticatedUser;

class RefreshTokenController extends Controller
{
    // use AuthenticatedUser;

    public function __invoke() 
    {
        // return response()->json([
        //     'user' => $this->user(),
        //     'date' => DateHelper::readableDate('1995-20-06')
        // ]);
       return response($content="");
    }

    
}
