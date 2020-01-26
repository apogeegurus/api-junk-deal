<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationGallery extends Model
{
    protected $fillable = ['location_id', 'file_name'];

    public function getPathAttribute()
    {
        return '/storage/locations/gallery/' . $this->attributes['location_id'] . '/' . $this->attributes['file_name'];
    }
}
