<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    protected $fillable = ['title', 'sub_title', 'specialize_title', 'banner_one_text', 'banner_two_text', 'how_it_works_title', 'how_it_works_sub_title', 'step_1_text', 'step_2_text', 'step_3_text', 'video_title', 'banner_first', 'banner_second'];

    protected $appends = ['banner_first_path', 'banner_second_path'];


    public function getBannerFirstPathAttribute()
    {
        return url('/storage/home/banners/' . $this->banner_first);
    }

    public function getBannerSecondPathAttribute()
    {
        return url('/storage/home/banners/' . $this->banner_second);
    }

}
