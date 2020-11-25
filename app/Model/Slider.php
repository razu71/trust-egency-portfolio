<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['main_title', 'sub_title_one', 'sub_title_two', 'image'];
}
