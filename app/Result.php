<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Result extends Model
{
    protected $fillable = ['sample_id', 'version', 'result'];

    // public function getCreatedAtAttribute($created_at)
    // {
    //     return Carbon::parse($created_at)->diffForHuman();
    // }
}
