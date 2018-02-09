<?php

namespace App\Http\Controllers;

use Goutte;
use App\User;
use App\Message;
use App\PostedBook;
use App\Transaction;
use App\Conversation;
use Illuminate\Http\Request;
use App\Http\Traits\AuthenticatedUser;
use App\Http\Requests\SendMessageRequest;


class MessageController extends Controller
{
    use AuthenticatedUser;

    public function send(SendMessageRequest $r)
    {
        if($this->user()){
            
            if($r->conversation_id){
                $m = ['conversation_id' => $r->conversation_id, 'message' => $r->message,'recipient_id' => $r->recipient_id,'sender_id'=> $this->user()->id];
                $res = Message::create($m);
            }else{
                
                $c = Conversation::where(['user_id1' => $this->user()->id,
                'user_id2' => $r->recipient_id,
                'posted_id' => $r->posted_id ])
                ->get();

                if($c->count() > 0){
                    $m = ['conversation_id' => $c[0]->id, 'message' => $r->message,'recipient_id' => $r->recipient_id,'sender_id'=> $this->user()->id];
                    $res = Message::create($m);
                }else{
                    $conversation = ['user_id1' => $this->user()->id, 'user_id2' => $r->recipient_id, 'posted_id' => $r->posted_id];
                    $res = Conversation::create($conversation);
                    $m = ['conversation_id' => $res->id, 'message' => $r->message,'recipient_id' => $r->recipient_id,'sender_id'=> $this->user()->id];
                    $res = Message::create($m);
                }
               
            }
            
            if($res->id){
                return response()->json(['message' => 'Message successfully sent!' ]);
            }
        }
    }
    public function retrieveConversation(Request $r){
       
       
        if($this->user()){
            
            //return response()->json( User::whereId($this->user()->id)->with('conversation.receiver')->get() );
            $user = User::find($this->user()->id);
            
            if($r->q == null){
                $conversation = Conversation::whereUserId1($this->user()->id)->orWhere('user_id2',$this->user()->id)->orderBy('id', 'desc')->get();   
            }else{
                $conversation = Conversation::wherePostedId($r->q)->orderBy('id', 'desc')->get(); 
            }
            
            $converse = $conversation->map(function($item){
                return [
                    'conversation_id' => $item->id,
                    'name' => $item->user_id2 == $this->user()->id ? User::getName($item->user_id1) : User::getName($item->user_id2),
                    'image' => $item->user_id2 == $this->user()->id ? User::image($item->user_id1) : User::image($item->user_id2),
                    'book' => PostedBook::find($item->posted_id)->title
                   ];
            });

            return response()->json(['data' => $converse]);
            
           
           
        }
    }

    public function retrieveChatMessages(Request $r){

        
        if ( $this->user()) {
            $c = Conversation::find($r->id);
            $m = Message::whereConversationId($c->id)->get();
            
            $p = PostedBook::whereId($c->posted_id)->get();
            $w = $c->user_id2 == $this->user()->id ? User::getUser($c->user_id1) : User::getUser($c->user_id2);
            $t = Transaction::where('posted_book_id','=', $p[0]->id)->whereCancelledAt(null)->get();
            
            return response()->json([
              'data' => $m,
              'conversation_with' => $w,
              'item' => $p,
              'is_transacted' => $t->count() > 0 ? 'transacted' : null,
              'transaction_details' => $t->count() > 0 ? $t : null,
            ]);
        }
    }
    public function message()
    {
        if($this->user()){
           return response()->json([
               'data' => Message::GroupMessage($this->user()->id)->with(['sender'])->get()
               ]);
        }
    }
    public function mobileMessages(){
        return response()->json([
               'data' => Message::with(['sender'])->groupBy('sender_id')->get()
               ]);
    }
    public function messageNofication(Request $r)
    {
        $user = User::find($this->user()->id);
        
        $count = Message::whereRecipientId($this->user()->id)->get()->count();
        
        $new = false;
        $number_of_new = 0;

        if($r->count == $count || $r->count == 0){
            $new = false;
        }else{
            $number_of_new = $count - $r->count;
            $new = true;
        }
        

        return response()->json([
           'count' => $count,
           'new' => $new,
           'number_of_new' => $number_of_new
        ]);
    }
    
    public function getInboxCount()
    {
        $user = User::find($this->user()->id);        
        $conversation = Conversation::whereUserId1($this->user()->id)->orWhere('user_id2',$this->user()->id)->get()->count();

       
        return response(['data' => $conversation ]);
    }
}
