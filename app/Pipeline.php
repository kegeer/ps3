<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pipeline extends Model
{
    protected $fillable = ['roadmap_id', 'step', 'procedure_id', 'protocol_id', 'time'];

    public function roadmap()
    {
        return $this->belongsTo('App\Roadmap');
    }
}
