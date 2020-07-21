<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Places extends Model
{
    protected $fillable = ['name', 'address', 'phone', 'url', 'location_id'];
}
