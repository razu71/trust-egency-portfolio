<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sms extends Model
{
    use SoftDeletes;
    protected $fillable = ['to','message','token'];
    protected $dates = ['deleted_at'];
}
