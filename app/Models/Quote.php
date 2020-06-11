<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'zip_code', 'date', 'description', 'reply'];

    public function getCreatedAtAttribute()
    {
        return Carbon::createFromFormat("Y-m-d H:i:s", $this->attributes["created_at"])->timezone("America/Los_Angeles")->format("Y-m-d H:i:s");
    }
}
