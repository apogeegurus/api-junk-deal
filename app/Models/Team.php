<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'position', 'avatar'];

    protected $appends = ['avatar_path'];

    public function getAvatarPathAttribute()
    {
        return url('/storage/teams/members/' . $this->attributes['avatar']);
    }
}
