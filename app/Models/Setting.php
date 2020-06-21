<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['phone', 'phone_footer', 'office_hours', 'office_hours_footer', 'email', 'about_footer', 'location', 'facebook', 'youtube', 'yelp', 'bbb', 'map_address'];

}
