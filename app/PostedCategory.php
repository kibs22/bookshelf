<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PostedCategory extends Model
{
     use notifiable;

    protected $fillable = [
        'posted_id', 'category_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function posted()
    {
        return $this->belongsToMany('App\PostedBook');
    }
    public function category()
    {
        return $this->hasMany('App\Category','category_id');
    }

    public function postedBook()
    {
        return $this->belongsTo('App\PostedBook', 'posted_id');
    }
}
