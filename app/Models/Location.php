<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use Sluggable;

    protected $fillable = ['city', 'title', 'sub_title', 'description', 'facts_left', 'facts_right', 'website',
        'city_phone', 'police_address', 'police_phone', 'police_email', 'donate_address', 'donate_phone',
        'weather', 'weather_icon', 'main_image', 'banner_first', 'banner_second', 'lat', 'lon', 'slug', 'url'];

    protected $appends = ['main_image_path', 'banner_first_path', 'banner_second_path'];

    /**
     * Overrides the created_at attribute with pacific timezone and corrected format
     *
     * @return string
     */
    public function getCreatedAtAttribute()
    {
        return Carbon::createFromFormat("Y-m-d H:i:s", $this->attributes["created_at"])->timezone("America/Los_Angeles")->format("F d Y H:i:s");
    }
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'city'
            ]
        ];
    }

    public function getMainImagePathAttribute()
    {
        return url('/storage/locations/main/' . $this->main_image);
    }

    public function getBannerFirstPathAttribute()
    {
        return url('/storage/locations/banners/' . $this->banner_first);
    }

    public function getBannerSecondPathAttribute()
    {
        return url('/storage/locations/banners/' . $this->banner_second);
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
