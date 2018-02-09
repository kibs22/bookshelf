<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Message extends Model
{
    use notifiable;

    protected $fillable = [
       'message','sender_id','recipient_id','conversation_id',
    ];

    public function sender()
    {
        return $this->belongsTo('App\user','sender_id');
    }
    public function scopeGroupMessage($query,$logged_in){
        return $query->groupBy('sender_id')
        ->having('recipient_id', '=', $logged_in)
        ->latest();
    }
    public function scopeThreadMessages($query,$logged_in)
    {   
       return $query->join('users as sender','sender.id','=','messages.sender_id')
        ->select('sender.*','messages.*')
        ->addSelect(DB::raw('IF(sender.id = messages.sender_id, CONCAT(sender.firstname," ",sender.lastname), "")  AS sender'))
        ->addSelect(DB::raw('IF(sender.id = messages.sender_id, messages.sender_id, "")  AS sender_id'))
        ->where('messages.sender_id','!=',$logged_in)
        ->where('messages.recipient_id','=',$logged_in);
    }

    public function conversation()
    {
        return $this->belongsTo('App\conversation');
    }
   
}
