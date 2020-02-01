<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $settings = Setting::query()->first();
        return response()->json(['settings' => $settings]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexTestimonials()
    {
        $testimonials = Testimonial::query()
            ->select('name', 'description')
            ->get();
        return response()->json(['testimonials' => $testimonials]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexSlider()
    {
        $sliders = Slider::query()
            ->select('id', 'file_name')
            ->get();

        return response()->json(['sliders' => $sliders]);
    }
}
