<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['headline', 'sub_headline', 'author', 'description', 'main_image', 'slug'];
    use Sluggable;

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
                'source' => 'headline'
            ]
        ];
    }


    public function getMainImagePathAttribute()
    {
        return url('/storage/blogs/main/' . $this->attributes['main_image']);
    }
}
