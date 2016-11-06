<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Sample extends Model
{
    protected $fillable = [
        'batch_id',
        'client_id' ,
        'ori_num',
        'py_num',
        'amount',
        'sampling_time',
        'split_time',
        'split_type',
        'due_time'
    ];

    public function getSamplingTimeAttribute($sampling_time)
    {
        return Carbon::parse($sampling_time)->toDateString();
    }
    public function getSplitTimeAttribute($split_time)
    {
        return Carbon::parse($split_time)->toDateString();
    }
    public function getDueTimeAttribute($due_time)
    {
        return Carbon::parse($due_time)->toDateString();
    }

}
