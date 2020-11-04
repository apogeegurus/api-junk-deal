<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationGallery extends Model
{
    protected $fillable = ['location_id', 'file_name', 'hex_code', 'order','alt'];

    protected $appends = ['path'];

    public function getPathAttribute()
    {
        if(empty($this->attributes["hex_code"])) {
            return url('/storage/locations/gallery/' . $this->attributes['location_id'] . '/' . $this->attributes['file_name']);
        }

        return null;
    }
}
