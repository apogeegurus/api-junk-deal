<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    protected $fillable = ['title', 'sub_title', 'specialize_title', 'banner_one_text', 'banner_two_text', 'how_it_works_title', 'how_it_works_sub_title', 'step_1_text', 'step_2_text', 'step_3_text', 'video_title'];

}
