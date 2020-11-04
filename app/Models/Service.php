<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use Sluggable;

    protected $fillable = ['title', 'slug', 'sub_title', 'short_description', 'long_description', 'main_image','alt'];

    protected $appends = ['main_image_path'];

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
                'source' => 'title'
            ]
        ];
    }


    public function gallery()
    {
        return $this->hasMany(ServiceImage::class, 'service_id', 'id');
    }

    public function sliders()
    {
        return $this->hasMany(ServiceSlider::class, 'service_id', 'id');
    }


    public function getMainImagePathAttribute()
    {
        return url('/storage/services/main/' . $this->attributes['main_image']);
    }
}
