<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationGallery extends Model
{
    protected $fillable = ['location_id', 'file_name'];

    protected $appends = ['path'];

    public function getPathAttribute()
    {
        return url('/storage/locations/gallery/' . $this->attributes['location_id'] . '/' . $this->attributes['file_name']);
    }
}
