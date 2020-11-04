<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexNames()
    {
        $services = Service::query()
            ->select(['title', 'slug', 'main_image', 'short_description','alt'])
            ->get();

        return response()->json(['services' => $services]);
    }


    /**
     * @param $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($slug)
    {
        $service = Service::query()
            ->select('title', 'sub_title', 'short_description', 'long_description', 'main_image', 'id')
            ->with(['gallery' => function ($query) {
                $query->orderBy("order", "ASC");
            }, 'sliders' => function ($query) {
                $query->orderBy("order", "ASC");
            }])
            ->where('slug', '=', $slug)
            ->firstOrFail();

        return response()->json(['service' => $service]);
    }
}
