<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Conversation extends Model
{
  	use notifiable;

    protected $fillable = [
       'user_id1','user_id2','posted_id',
    ];

    public function inbox()
    {
        return $this->belongsTo('App\user','user_id1','user_id2','id');
    }

    public function sender()
    {
        return $this->belongsTo('App\user', 'user_id2');
    }
    public function receiver()
    {
        return $this->belongsTo('App\User','user_id2');
    }

    public function message()
    {
        return $this->hasMany('App\message');
    }
    public function messageCount()
    {
       return self::message();
    }

    public function InterestedUsersDetails()
    {
        return $this->belongsTo('App\User','user_id1');
    }
   
}  
