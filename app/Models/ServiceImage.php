<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceImage extends Model
{
    protected $fillable = ['service_id', 'file_name'];

    protected $appends = ['path'];

    public function getPathAttribute()
    {
        return url("/storage/services/{$this->service_id}/{$this->file_name}");
    }
}
