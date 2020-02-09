<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'zip_code', 'date', 'description', 'reply'];

}
