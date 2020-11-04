<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['file_name', 'order','alt'];

    protected $appends = ['path'];

    public function getPathAttribute()
    {
        return url('/storage/sliders/' . $this->attributes['file_name']);
    }
}
