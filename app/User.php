<?php

namespace App;

use DB;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname','MI','lastname','email','password','mobile','address','confirm_key', 'key', 'role_type', 'image', 'blocked_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['unblock_eligibility'];

    public function posts()
    {
        return $this->hasMany('App\PostedBook','user_id');
    }
    
    public  function conversation()
    {
        return $this->hasMany('App\Conversation','user_id1');
    }

    public static function getName($id)
    {
        $res = self::select('firstname','lastname')->whereId($id)->get();
        return $res[0]->firstname.' '.$res[0]->lastname;
    }

    public static function image($id)
    {
        $res = self::select('image')->whereId($id)->get();
        return $res[0]->image;
    }

    public static function getUser($id)
    {
        return $res = self::find($id);
    }

    public function myReviews()
    {
        return $this->hasMany('App\Review', 'user_id');        
    }

    public function Reports()
    {
        return $this->hasMany('App\UserReport', 'reported_to')->where('cleared_at', null);
    }

    // public function accumulatedReports()
    // {
    //     return $this->Reports();
    // }

    public function getUnblockEligibilityAttribute()
    {
        if($this->blocked_at == null){
            return true;
        }
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->blocked_at, 'Asia/Manila' )
        ->diffInDays(Carbon::now('Asia/Manila')) >= 3 ;

    }

    public function scopeWithReportCount($query)
    {
        return $query->whereNull('blocked_at')->withCount('Reports');
    }


    public function scopeWithMoreThanThreeReports($query)
    {
        return $query->whereHas('Reports');
    }

}
