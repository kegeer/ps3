<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    protected $fillable =['name', 'project_id', 'roadmap_id', 'exp_manager', 'info_manager', 'start', 'end'];

    public function getStartAttribute($start)
    {
        return Carbon::parse($start)->toDateString();
    }
    public function getEndAttribute($end)
    {
        return Carbon::parse($end)->toDateString();
    }
}
