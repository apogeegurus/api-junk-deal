<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = ['title', 'description', 'image'];

    protected $appends = ['image_path'];


    public function getImagePathAttribute()
    {
        return url('/storage/about/' . $this->attributes['image']);
    }
}
