<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceImage extends Model
{
    protected $fillable = ['service_id', 'file_name'];

    public function getPathAttribute()
    {
        return "/storage/services/{$this->service_id}/{$this->file_name}";
    }
}
