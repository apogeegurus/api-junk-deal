<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use Sluggable;

    protected $fillable = ['title', 'slug', 'sub_title', 'short_description', 'long_description', 'main_image'];

    protected $appends = ['main_image_path'];

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


    public function getMainImagePathAttribute()
    {
        return url('/storage/services/main/' . $this->attributes['main_image']);
    }
}
