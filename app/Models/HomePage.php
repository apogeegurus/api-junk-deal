<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    protected $fillable = ['title', 'sub_title', 'specialize_title', 'banner_one_text', 'banner_two_text', 'how_it_works_title', 'how_it_works_sub_title', 'step_1_text', 'step_2_text', 'step_3_text', 'video_title', 'banner_first', 'banner_second', 'step_one', 'step_two', 'step_three', 'animation_back', 'animation_front', 'animation_truck', 'back_duration', "front_duration"];

    protected $appends = ['banner_first_path', 'banner_second_path', 'animation_front_path', 'animation_back_path', 'animation_truck_path', 'step_one_path', 'step_two_path', 'step_three_path'];


    public function getBannerFirstPathAttribute()
    {
        return url('/storage/home/banners/' . $this->banner_first);
    }

    public function getAnimationFrontPathAttribute()
    {
        return url('/storage/home/animations/' . $this->animation_front);
    }

    public function getAnimationBackPathAttribute()
    {
        return url('/storage/home/animations/' . $this->animation_back);
    }

    public function getAnimationTruckPathAttribute()
    {
        return url('/storage/home/animations/' . $this->animation_truck);
    }

    public function getStepOnePathAttribute()
    {
        return url('/storage/home/steps/' . $this->step_one);
    }

    public function getStepTwoPathAttribute()
    {
        return url('/storage/home/steps/' . $this->step_two);
    }

    public function getStepThreePathAttribute()
    {
        return url('/storage/home/steps/' . $this->step_three);
    }

    public function getBannerSecondPathAttribute()
    {
        return url('/storage/home/banners/' . $this->banner_second);
    }

}
