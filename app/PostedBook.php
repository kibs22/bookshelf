<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostedBook extends Model
{
    use notifiable;
    use SoftDeletes;

    protected $fillable = [
        'seller_id', 'price', 'description','author','year','title','availability','image','isbn',
    ];
    protected $dates = ['deleted_at'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
    public function postedBy()
    {
        return $this->belongsTo('App\User','seller_id');
    }
    public function postedCategory()
    {
        return $this->hasMany('App\PostedCategory','posted_id');
    }
    public function getCategory()
    {
        return $this->belongsToMany('App\Category','posted_categories','posted_id','category_id');
    }
    public function scopeSearch($query, $search)
    {
        return $query->where('title','like','%' .$search. '%')->orWhere('isbn','like','%'. $search .'%')->orWhere('author', 'like','%' .$search. '%' );
    }
    
    public function scopeDetails($query, $id)
    {
        return $query->whereId($id);
    }

    public static function getSearchedCategory($cat){
        return self::with('postedBy')->join('posted_categories', 'posted_books.id', '=', 'posted_categories.posted_id')
        ->join('categories','posted_categories.category_id','=','categories.id')
        ->select('posted_categories.*' , 'categories.*', 'posted_books.*')
        ->where('categories.name', $cat)
        ->where('posted_books.availability', 0)
        ->orderBy('posted_books.id', 'desc')
        ->get();
    }
   public function hasReviews()
   {
       return $this->hasOne('App\Review','posted_id');
   }

   public function hasManyUsersInterested()
   {
      return $this->hasMany('App\Conversation','posted_id');
   }

   public function isTransacted()
   {
       return $this->hasOne('App\Transaction')->whereCancelled_at(null);
   }

   public function reports()
   {
      return $this->hasOne('App\UserReport','book_id');
   }


}
