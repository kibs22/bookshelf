<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['posted_book_id', 'sold_to'];

    public function posted()
    {
       return  $this->belongsTo('App\PostedBook','posted_book_id');
    }

    public function soldTo()
    {
        return $this->belongsTo('App\User','sold_to');
    }
    
   
}
