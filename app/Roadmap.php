<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    protected $fillable = ['name', 'description'];

    public function pipelines()
    {
        return $this->hasMany('App\Pipeline');
    }
}
