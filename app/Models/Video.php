<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['title', 'description', 'video_url', 'is_mobile'];

    protected $appends = ['video_id'];

    public function getVideoIdAttribute()
    {
        $parts = parse_url($this->attributes['video_url']);
        if(!isset($parts['query'])) return null;
        parse_str($parts['query'], $query);
        return $query['v'] ?? null;
    }
}
