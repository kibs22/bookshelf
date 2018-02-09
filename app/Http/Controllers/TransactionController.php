<?php

namespace App\Http\Controllers;

use JWTAuth;
use Carbon\Carbon;
use App\PostedBook;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Traits\AuthenticatedUser;

class TransactionController extends Controller
{
    use AuthenticatedUser;

    public function sell(Request $r)
    {   
       $req = $r;

       $res = Transaction::create($req->toArray());
       
       if($res->id){
           $p = PostedBook::find($res->posted_book_id);
           $p->availability = 1;
           $p->save();

       }
       return response()->json([ 'success' => true ]);
    }
    public function myTransaction()
    {
        $transaction = Transaction::with(['posted' => function($q){
            $q->whereSellerId($this->user()->id );
        },'soldTo'])->whereCancelledAt(null)->get();

        $filtered = $transaction->filter(function($item){
                    if( $item->posted != null){
                        return $item;
                    }
        })->values();

         
        return response()->json( ['wee' =>  $filtered  ]);
    }

    public function myBought()
    {
        $bought = Transaction::with(['posted.postedBy','posted.hasReviews','posted.reports'])->where([
            ['cancelled_at',null],
            ['sold_to' ,'=', $this->user()->id],
            ['flag' ,'!=', null]
        ])->get();
        return response()->json( ['wee' => $bought] );
    }

    public function setComplete(Request $r)
    {
       if($this->user()){
    
            $res = Transaction::find($r->transaction_id);
            $res->flag = 'complete';
            $res->save();
            
            // $post  = PostedBook::find($res->posted->id);
            // $post->availability = 1;
            // $post->save();

            return response()->json(['success' => true]);
       }
    }

    public function setCancel(Request $r)
    {
       if($this->user()){
    
            $res = Transaction::find($r->transaction_id);
            $res->flag = null;
            $res->cancelled_at = Carbon::now();
            $res->save();

            $post = PostedBook::find($res->posted_book_id);

            $post->availability = 0;
            $post->save();

            return response()->json(['success' => true]);
       }
    }
}
