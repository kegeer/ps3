<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'gender',
        'birthday',
        'weight',
        'source',
        'height',
        'weight',
        'waistline',
        'phone',
        'disease',
        'disease_history'
    ];

    public function samples()
    {
        return $this->hasMany('App\Sample');
    }
}
