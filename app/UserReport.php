<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserReport extends Model
{
    protected $fillable = ['reported_by', 'book_id', 'reported_to','others'];
}
