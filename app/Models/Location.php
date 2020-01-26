<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['city', 'title', 'sub_title', 'description', 'facts_left', 'facts_right', 'website',
        'city_phone', 'police_address', 'police_phone', 'police_email', 'donate_address', 'donate_phone',
        'weather', 'weather_icon', 'main_image', 'banner_first', 'banner_second', 'lat', 'lon'];

    public function getMainImagePathAttribute()
    {
        return '/storage/locations/main/' . $this->main_image;
    }

    public function getBannerFirstPathAttribute()
    {
        return '/storage/locations/banners/' . $this->banner_first;
    }

    public function getBannerSecondPathAttribute()
    {
        return '/storage/locations/banners/' . $this->banner_second;
    }


    public function gallery()
    {
        return $this->hasMany(LocationGallery::class, 'location_id', 'id');
    }

    public function slider()
    {
        return $this->hasMany(LocationSlider::class, 'location_id', 'id');
    }
}
