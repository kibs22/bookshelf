<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
	use SoftDeletes;
    protected $fillable = ['name', 'category_id'];
 
    
    public function getdetails()
    {
        return $this->hasMany('App\PostedCategory');
    }

    public function postedCategory()
    {
    	return $this->hasMany('App\PostedCategory');
    }
}
