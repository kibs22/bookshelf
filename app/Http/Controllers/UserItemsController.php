<?php

namespace App\Http\Controllers;

use App\PostedBook;
use Illuminate\Http\Request;
use App\Http\Traits\AuthenticatedUser;

class UserItemsController extends Controller
{
    use AuthenticatedUser;

    public function __invoke()
    {
        if($this->user()){
            return response()->json(['posts' => PostedBook::where([
                [ 'seller_id', '=' , $this->user()->id ]
            ])->with(['postedCategory','getCategory','hasManyUsersInterested.InterestedUsersDetails','isTransacted'])->orderBy('id', 'desc')->get()]);
        }
    }
}
