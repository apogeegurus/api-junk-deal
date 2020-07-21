<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YelpPlace extends Model
{
    protected $fillable = ["img", "rating", "address", "name", "url", "location_id"];

}
