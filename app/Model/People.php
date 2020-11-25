<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $fillable = ['name','designation','image'];
}
