<?php

namespace App\Http\Controllers;

use App\User;
use App\Review;
use Illuminate\Http\Request;
use App\Http\Traits\AuthenticatedUser;

class ReviewController extends Controller
{
    use AuthenticatedUser;
    
    public function makeReview(Request $r)
    {
        $this->validate($r, ['message' => 'required']);

        if($this->user()){
            $data = [
                'user_id' => $r->reviewed_for,
                'reviewer_id' => $this->user()->id,
                'content' => $r->message,
                'posted_id' => $r->posted_id
            ];
            
            $res = Review::create($data);

            if($res->id){
                return response()->json(['success' => true]);
            }
        }
    }
    public function myReviews()
    {
        $user = User::with('myReviews.reviewer')->find($this->user()->id);

        if($this->user()){
            return response()->json(['data' => $user->count() ? $user->myReviews : null ]);
        }
    }
}
