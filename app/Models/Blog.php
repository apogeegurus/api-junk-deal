<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['headline', 'sub_headline', 'author', 'description', 'main_image', 'slug'];
    use Sluggable;

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
                'source' => 'headline'
            ]
        ];
    }


    public function getMainImagePathAttribute()
    {
        return url('/storage/blogs/main/' . $this->attributes['main_image']);
    }
}
