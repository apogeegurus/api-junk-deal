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
            ->select('city', 'main_image', 'sub_title','alt_main','alt_city_emblem', DB::raw("IFNULL(url, slug) as slug"))
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
            ->select('*')
            ->with(["gallery" => function($query) {
                $query->orderBy("order", "ASC");
            }, 'slider'  => function($query) {
                $query->orderBy("order", "ASC");
            }, 'places', 'yelp_places'])
            ->where('slug', '=', $slug)
            ->orWhere('url', '=', $slug)
            ->firstOrFail();

        return response()->json(['location' => $location]);
    }
}
