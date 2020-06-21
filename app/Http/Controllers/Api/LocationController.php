<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::query()
            ->select('city', 'main_image', 'sub_title', DB::raw("IFNULL(url, slug) as slug"))
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        return response()->json(['locations' => $locations]);
    }


    public function indexNames()
    {
        $locations = Location::query()
            ->select(['city', DB::raw("IFNULL(url, slug) as slug")])
            ->get();

        return response()->json(['locations' => $locations]);
    }

    /**
     * @param $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($slug)
    {
        $location = Location::query()
            ->select('city', 'title', 'sub_title', 'description', 'facts_left', 'facts_right', 'website',
                'city_phone', 'police_address', 'police_phone', 'police_email', 'donate_address', 'donate_phone',
                'weather', 'weather_icon', 'main_image', 'banner_first', 'banner_second', 'lat', 'lon', 'id')
            ->with('gallery:id,file_name,location_id', 'slider:id,file_name,location_id')
            ->where('slug', '=', $slug)
            ->orWhere('url', '=', $slug)
            ->firstOrFail();

        return response()->json(['location' => $location]);
    }
}
