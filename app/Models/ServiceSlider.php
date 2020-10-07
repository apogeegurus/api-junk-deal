<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSlider extends Model
{
    protected $fillable = ['service_id', 'file_name', 'order'];

    protected $appends = ['path'];

    public function getPathAttribute()
    {
        return url('/storage/services/slider/' . $this->attributes['service_id'] . '/' . $this->attributes['file_name']);
    }
}
