<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Quote extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'zip_code', 'date', 'description', 'reply'];

    protected $appends = ["date_scheduled"];

    /**
     * Overrides the created_at attribute with pacific timezone and corrected format
     *
     * @return string
     */
    public function getCreatedAtAttribute()
    {
        return Carbon::createFromFormat("Y-m-d H:i:s", $this->attributes["created_at"])->timezone("America/Los_Angeles")->format("F d Y H:i:s");
    }

    public function getDateScheduledAttribute()
    {
        return Carbon::createFromFormat("Y-m-d", $this->attributes["date"])->format("F d Y");
    }

    public function getQuotes(){
        return DB::table('quotes')->select('id','name','email','zip_code','description');
    }
}
