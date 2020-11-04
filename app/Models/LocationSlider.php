<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationSlider extends Model
{
    protected $fillable = ['location_id', 'file_name', 'order','alt'];

    protected $appends = ['path'];

    public function getPathAttribute()
    {
        return url('/storage/locations/slider/' . $this->attributes['location_id'] . '/' . $this->attributes['file_name']);
    }
}
