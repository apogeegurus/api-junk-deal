<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationSlider extends Model
{
    protected $fillable = ['location_id', 'file_name'];

    public function getPathAttribute()
    {
        return '/storage/locations/slider/' . $this->attributes['location_id'] . '/' . $this->attributes['file_name'];
    }
}
