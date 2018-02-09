<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['user_id','reviewer_id','content','posted_id'];

    public function reviewer()
    {
       return  $this->belongsTo('App\User', 'reviewer_id');
    }
}
