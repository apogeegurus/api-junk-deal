<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $settings = Setting::query()->first();
        return response()->json(['settings' => $settings]);
    }
}
