<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Batch extends Model
{
    protected $fillable = ['ori_num', 'py_num', 'manager', 'samples_amount', 'samples_type', 'trans_method', 'sender', 'send_time', 'sender_contact', 'recipients', 'arrive_time', 'express_num', 'arrive_status', 'store_method', 'store_location', 'note'];

    public function getSendTimeAttribute($send_time)
    {
        return Carbon::parse($send_time)->toDateString();
    }
    public function getArriveTimeAttribute($arrive_time)
    {
        return Carbon::parse($arrive_time)->toDateString();
    }

}
