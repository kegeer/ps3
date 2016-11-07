<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Protocol extends Model
{
    protected $fillable = ['procedure_id', 'name', 'description', 'content'];
    
}
