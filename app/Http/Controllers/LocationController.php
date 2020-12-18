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
            'what_to_eat',
            'where_to_go',
            'website',
            'address',
            'city_phone',
            'population',
            'average_age',
            'median_income',
            'median_home_value',
            'wiki_link',
            'lon',
            'lat',
            'url',
            'alt_main',
            'alt_city_emblem',
            'alt_banner_first',
            'alt_banner_second',
            'meta_description',
            'meta_title'
        ]);


        $mainImage      = $request->file('main_image');
        $ext            = $mainImage->getClientOriginalExtension();
        $fileNameMain   = Str::random(32) . ".{$ext}";
        Storage::disk('public')->putFileAs("locations/main", $mainImage, $fileNameMain);

        $cityEmblem     = $request->file('city_emblem');
        $ext            = $cityEmblem->getClientOriginalExtension();
        $fileNameEmblem = Str::random(32) . ".{$ext}";
        Storage::disk('public')->putFileAs("locations/emblem", $cityEmblem, $fileNameEmblem);


        $bannerFirst  = $request->file('banner_first');
        $ext          = $bannerFirst->getClientOriginalExtension();
        $fileNameBannerFirst = Str::random(32) . ".{$ext}";
        Storage::disk('public')->putFileAs("locations/banners", $bannerFirst, $fileNameBannerFirst);


        $bannerSecond  = $request->file('banner_second');
        $ext           = $bannerSecond->getClientOriginalExtension();
        $fileNameBannerSecond = Str::random(32) . ".{$ext}";
        Storage::disk('public')->putFileAs("locations/banners", $bannerSecond, $fileNameBannerSecond);

        $data = [
            'main_image' => $fileNameMain,
            'banner_second' => $fileNameBannerSecond,
            'banner_first' => $fileNameBannerFirst,
            'city_emblem' => $fileNameEmblem
        ] + $data;

        Location::query()->create($data);
        Artisan::call("populate:weather");
        Artisan::call("populate:yelp-places");
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
            'what_to_eat',
            'where_to_go',
            'website',
            'address',
            'city_phone',
            'population',
            'average_age',
            'median_income',
            'median_home_value',
            'wiki_link',
            'lon',
            'lat',
            'url',
            'alt_main',
            'alt_city_emblem',
            'alt_banner_first',
            'alt_banner_second',
            'meta_description',
            'meta_title'
        ]);

        $mainImage    = $request->file('main_image');
        $bannerFirst  = $request->file('banner_first');
        $bannerSecond = $request->file('banner_second');
        $cityEmblem   = $request->file('city_emblem');


        if(!empty($mainImage)) {
            Storage::disk('public')->delete("locations/main/{$location->main_image}");
            $ext = $mainImage->getClientOriginalExtension();
            $fileName = Str::random(32) . ".{$ext}";
            Storage::disk('public')->putFileAs("locations/main", $mainImage, $fileName);

            $data = ['main_image' => $fileName] + $data;
        }

        if(!empty($cityEmblem)) {
            Storage::disk('public')->delete("locations/emblem/{$location->city_emblem}");
            $ext = $cityEmblem->getClientOriginalExtension();
            $fileName = Str::random(32) . ".{$ext}";
            Storage::disk('public')->putFileAs("locations/emblem", $cityEmblem, $fileName);

            $data = ['city_emblem' => $fileName] + $data;
        }


        if(!empty($bannerFirst)) {
            Storage::disk('public')->delete("locations/banners/{$location->banner_first}");
            $ext = $bannerFirst->getClientOriginalExtension();
            $fileName = Str::random(32) . ".{$ext}";
            Storage::disk('public')->putFileAs("locations/banners", $bannerFirst, $fileName);

            $data = ['banner_first' => $fileName] + $data;
        }


        if(!empty($bannerSecond)) {
            Storage::disk('public')->delete("locations/banners/{$location->banner_first}");
            $ext = $bannerSecond->getClientOriginalExtension();
            $fileName = Str::random(32) . ".{$ext}";
            Storage::disk('public')->putFileAs("locations/banners", $bannerSecond, $fileName);

            $data = ['banner_second' => $fileName] + $data;
        }


        $location->update($data);
        Artisan::call("populate:weather");
        Artisan::call("populate:yelp-places");
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
        Storage::disk('public')->delete("services/emblem/{$location->city_emblem}");
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
            'file' => 'nullable|array',
            'file.*' => 'image',
            'alt' => 'nullable|max:20|string',
            'hex_code' => 'nullable'
        ]);

        $files = $request->file('file');

        if(!empty($request->hex_code)) {
            LocationGallery::query()->create([
                'location_id' => $location,
                'hex_code'  => $request->hex_code
            ]);
        } else {
            foreach ($files as $file) {
                $ext = $file->getClientOriginalExtension();
                $fileName = Str::random(32) . ".{$ext}";
                LocationGallery::query()->create([
                    'location_id' => $location,
                    'file_name'  => $fileName,
                    'alt' => $request->alt
                ]);

                Storage::disk('public')->putFileAs("locations/gallery/{$location}", $file, $fileName);
            }
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
            'file.*' => 'image',
            'alt' => 'nullable|max:20|string',
        ]);

        $files = $request->file('file');

        foreach ($files as $file) {
            $ext = $file->getClientOriginalExtension();
            $fileName = Str::random(32) . ".{$ext}";
            LocationSlider::query()->create([
                'location_id' => $location,
                'file_name'  => $fileName,
                'alt' => $request->alt
            ]);

            Storage::disk('public')->putFileAs("locations/slider/{$location}", $file, $fileName);
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


    /**
     * @param Request $request
     */
    public function orderChange(Request $request)
    {
        $orders  = $request->get("orders");
        foreach ($orders as $key => $order) {
            LocationGallery::query()
                ->where("id", "=", $order)
                ->update([
                    "order" => $key
                ]);
        }
    }

    /**
     * @param Request $request
     */
    public function orderChangeSlider(Request $request)
    {
        $orders  = $request->get("orders");
        foreach ($orders as $key => $order) {
            LocationSlider::query()
                ->where("id", "=", $order)
                ->update([
                    "order" => $key
                ]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function sliderEdit(LocationSlider $slider)
    {
        return view('locations.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function sliderUpdate(Request $request, LocationSlider $slider)
    {
        if($request->hasFile('file')) {
            Storage::delete('/public/locations/slider/' . $slider->location_id . '/' . $slider->file_name);
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();
            $fileName = Str::random(32) . ".{$ext}";

            Storage::disk('public')->putFileAs("locations/slider/{$slider->location_id}", $file, $fileName);
            $slider->update(['file_name' => $fileName, 'alt' => $request->alt]);
        }else{
            $slider->update([ 'alt' => $request->alt]);
        }

        return redirect()->route('locations.slider', ['location' => $slider->location_id]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LocationGallery  $slider
     * @return \Illuminate\Http\Response
     */
    public function galleryEdit(LocationGallery $gallery)
    {
        return view('locations.gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LocationGallery  $slider
     * @return \Illuminate\Http\Response
     */
    public function galleryUpdate(Request $request, LocationGallery $gallery)
    {
        $this->validate($request, [
            'file' => 'nullable|array',
            'file.*' => 'image',
            'alt' => 'nullable|max:20|string',
            'hex_code' => 'nullable'
        ]);

        $files = $request->file('file');

        if(!empty($request->hex_code)) {
            $gallery->update([
                'hex_code'  => $request->hex_code
            ]);
        } else {
            if(!empty($files)) {
                Storage::delete('/public/locations/gallery/' . $gallery->location_id . '/' . $gallery->file_name);

                foreach ($files as $file) {
                    $ext = $file->getClientOriginalExtension();
                    $fileName = Str::random(32) . ".{$ext}";
                    $gallery->update([
                        'file_name' => $fileName,
                        'alt' => $request->alt
                    ]);

                    Storage::disk('public')->putFileAs("locations/gallery/{$gallery->location_id}", $file, $fileName);
                }
            }else{
                $gallery->update([
                    'alt' => $request->alt
                ]);
            }
        }

        return redirect()->route('locations.gallery', ['location' => $gallery->location_id]);
    }
}
