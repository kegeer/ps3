<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Project extends Model
{
    protected $fillable = ['name', 'start', 'end', 'manager_user_id'];

    public function getStartAttribute($start)
    {
        return Carbon::parse($start)->toDateString();
    }
    public function getEndAttribute($end)
    {
        return Carbon::parse($end)->toDateString();
    }

}
