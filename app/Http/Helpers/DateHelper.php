<?php

namespace App\Http\Helpers;

use Carbon\Carbon;

class DateHelper 
{
    public static function readableDate($date) 
    {
        return Carbon::createFromFormat('Y-m-d', $date)->format('F d, Y');
    }
}