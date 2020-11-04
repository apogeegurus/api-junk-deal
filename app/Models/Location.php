<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use Sluggable;

    protected $fillable = ['city', 'title', 'sub_title', 'description', 'website',
        'city_phone','population', 'average_age', 'median_income', 'median_home_value', 'wiki_link', 'address', 'what_to_eat', 'where_to_go', 'city_emblem',
        'weather', 'weather_icon', 'main_image', 'banner_first', 'banner_second', 'lat', 'lon', 'slug', 'url','alt_city_emblem','alt_main','alt_banner_first','alt_banner_second'];

    protected $appends = ['main_image_path', 'banner_first_path', 'banner_second_path', 'city_emblem_path'];

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

    public function getCityEmblemPathAttribute()
    {
        return url('/storage/locations/emblem/' . $this->city_emblem);
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

    public function places()
    {
        return $this->hasMany(Places::class, 'location_id', 'id');
    }

    public function yelp_places()
    {
        return $this->hasMany(YelpPlace::class, 'location_id', 'id');
    }
}
