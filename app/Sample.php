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
        'sample_weight',
        'sample_date',
        'test_date',
        'is_reported',
        'report_date'
    ];

    public function getSampleTimeAttribute($sampling_time)
    {
        return Carbon::parse($sampling_time)->toDateString();
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function getSourceAttribute()
    {
        return $this->client->source;
    }

    public function getClientNameAttribute()
    {
        return $this->client->name;
    }

}
