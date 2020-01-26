<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['file_name'];


    public function getPathAttribute()
    {
        return '/storage/sliders/' . $this->attributes['file_name'];
    }
}
