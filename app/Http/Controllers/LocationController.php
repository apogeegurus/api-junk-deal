<?php

namespace App\Http\Controllers;

use App\Http\Requests\Location\Store;
use App\Http\Requests\Location\Update;
use App\Models\Location;
use App\Models\LocationGallery;
use App\Models\LocationSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::query()
            ->select('id', 'city', 'created_at')
            ->paginate(20);

        return view('locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $data = $request->only([
            'city',
            'title',
            'sub_title',
            'description',
            'facts_left',
            'facts_right',
            'website',
            'city_phone',
            'police_address',
            'police_phone',
            'police_email',
            'donate_address',
            'donate_phone',
            'lon',
            'lat',
            'url'
        ]);


        $mainImage      = $request->file('main_image');
        $ext            = $mainImage->getClientOriginalExtension();
        $fileNameMain   = Str::random(32) . ".{$ext}";
        $mainImage      = Image::make($mainImage)->encode($ext)->__toString();
        Storage::disk('public')->put("locations/main/$fileNameMain", $mainImage);


        $bannerFirst  = $request->file('banner_first');
        $ext          = $bannerFirst->getClientOriginalExtension();
        $fileNameBannerFirst = Str::random(32) . ".{$ext}";
        $bannerFirst  = Image::make($bannerFirst)->encode($ext)->__toString();
        Storage::disk('public')->put("locations/banners/$fileNameBannerFirst", $bannerFirst);


        $bannerSecond  = $request->file('banner_second');
        $ext           = $bannerSecond->getClientOriginalExtension();
        $fileNameBannerSecond = Str::random(32) . ".{$ext}";
        $bannerSecond  = Image::make($bannerSecond)->encode($ext)->__toString();
        Storage::disk('public')->put("locations/banners/$fileNameBannerSecond", $bannerSecond);

        $data = [
            'main_image' => $fileNameMain,
            'banner_second' => $fileNameBannerSecond,
            'banner_first' => $fileNameBannerFirst
        ] + $data;

        Location::query()->create($data);
        Artisan::call("populate:weather");
        return redirect()->route('locations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, Location $location)
    {
        $data = $request->only([
            'city',
            'title',
            'sub_title',
            'description',
            'facts_left',
            'facts_right',
            'website',
            'city_phone',
            'police_address',
            'police_phone',
            'police_email',
            'donate_address',
            'donate_phone',
            'lon',
            'lat',
            'url'
        ]);

        $mainImage    = $request->file('main_image');
        $bannerFirst  = $request->file('banner_first');
        $bannerSecond = $request->file('banner_second');


        if(!empty($mainImage)) {
            Storage::disk('public')->delete("locations/main/{$location->main_image}");
            $ext = $mainImage->getClientOriginalExtension();
            $fileName = Str::random(32) . ".{$ext}";
            $mainImage      = Image::make($mainImage)->encode($ext)->__toString();
            Storage::disk('public')->put("locations/main/$fileName", $mainImage);

            $data = ['main_image' => $fileName] + $data;
        }


        if(!empty($bannerFirst)) {
            Storage::disk('public')->delete("locations/banners/{$location->banner_first}");
            $ext = $bannerFirst->getClientOriginalExtension();
            $fileName = Str::random(32) . ".{$ext}";
            $bannerFirst  = Image::make($bannerFirst)->encode($ext)->__toString();
            Storage::disk('public')->put("locations/banners/$fileName", $bannerFirst);

            $data = ['banner_first' => $fileName] + $data;
        }


        if(!empty($bannerSecond)) {
            Storage::disk('public')->delete("locations/banners/{$location->banner_first}");
            $ext = $bannerSecond->getClientOriginalExtension();
            $fileName = Str::random(32) . ".{$ext}";
            $bannerSecond  = Image::make($bannerSecond)->encode($ext)->__toString();
            Storage::disk('public')->put("locations/banners/$fileName", $bannerSecond);

            $data = ['banner_second' => $fileName] + $data;
        }


        $location->update($data);
        Artisan::call("populate:weather");
        return redirect()->route('locations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        Storage::disk('public')->deleteDirectory('locations/gallery/' . $location->id);
        Storage::disk('public')->deleteDirectory('locations/slider/' . $location->id);
        Storage::disk('public')->delete("services/main/{$location->main_image}");
        Storage::disk('public')->delete("services/banners/{$location->banner_first}");
        Storage::disk('public')->delete("services/banners/{$location->banner_second}");

        $location->delete();
        return response()->json(['success' => true]);
    }



    public function galleryIndex($location)
    {
        $galleries = LocationGallery::query()->where('location_id', '=', $location)->get();
        return view('locations.gallery.index', compact('galleries'));
    }


    public function galleryCreate()
    {
        return view('locations.gallery.create');
    }

    /**
     * @param Request $request
     * @param $location
     * @throws \Illuminate\Validation\ValidationException
     */
    public function galleryStore(Request $request, $location)
    {
        $this->validate($request, [
            'file' => 'required|array',
            'file.*' => 'image'
        ]);

        $files = $request->file('file');

        foreach ($files as $file) {
            $ext = $file->getClientOriginalExtension();
            $fileName = Str::random(32) . ".{$ext}";
            LocationGallery::query()->create([
                'location_id' => $location,
                'file_name'  => $fileName
            ]);

            $file  = Image::make($file)->encode($ext)->__toString();
            Storage::disk('public')->put("locations/gallery/{$location}/$fileName", $file);
        }

        return redirect()->route('locations.gallery', ['location' => $location]);
    }


    public function destroyImageGallery($id)
    {
        $gallery = LocationGallery::query()->find($id);
        Storage::delete('/public/locations/gallery/' . $gallery->location_id . '/' . $gallery->file_name);
        $gallery->delete();

        return response()->json(['success' => true]);
    }


    public function sliderIndex($location)
    {
        $sliders = LocationSlider::query()->where('location_id', '=', $location)->get();
        return view('locations.slider.index', compact('sliders'));
    }



    public function sliderCreate()
    {
        return view('locations.slider.create');
    }


    /**
     * @param Request $request
     * @param $location
     * @throws \Illuminate\Validation\ValidationException
     */
    public function sliderStore(Request $request, $location)
    {
        $this->validate($request, [
            'file' => 'required|array',
            'file.*' => 'image'
        ]);

        $files = $request->file('file');

        foreach ($files as $file) {
            $ext = $file->getClientOriginalExtension();
            $fileName = Str::random(32) . ".{$ext}";
            LocationSlider::query()->create([
                'location_id' => $location,
                'file_name'  => $fileName
            ]);

            $file  = Image::make($file)->encode($ext)->__toString();
            Storage::disk('public')->put("locations/slider/{$location}/$fileName", $file);
        }

        return redirect()->route('locations.slider', ['location' => $location]);
    }


    public function destroyImageSlider($id)
    {
        $slider = LocationSlider::query()->find($id);
        Storage::delete('/public/locations/slider/' . $slider->location_id . '/' . $slider->file_name);
        $slider->delete();

        return response()->json(['success' => true]);
    }
}
