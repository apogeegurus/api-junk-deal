<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\Store;
use App\Http\Requests\Service\Update;
use App\Models\LocationGallery;
use App\Models\Service;
use App\Models\ServiceImage;
use App\Models\ServiceSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::query()
            ->select('services.id', 'services.title', 'services.created_at')
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $serviceData = $request->only(['title', 'sub_title', 'short_description', 'long_description']);
        $mainImage  = $request->file('mainImage');
        $ext = $mainImage->getClientOriginalExtension();
        $fileName = Str::random(32) . ".{$ext}";
        Storage::disk('public')->putFileAs("services/main/", $mainImage, $fileName);

        $data = ['main_image' => $fileName] + $serviceData;
        $service = Service::query()->create($data);

        $files = $request->file('gallery');


        foreach ($files as $file) {
            $ext = $file->getClientOriginalExtension();
            $fileName = Str::random(32) . ".{$ext}";
            ServiceImage::query()->create([
                'service_id' => $service->id,
                'file_name'  => $fileName
            ]);

            Storage::disk('public')->putFileAs("services/{$service->id}", $file, $fileName);
        }

        return redirect()->route('services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::query()
            ->with('gallery')
            ->findOrFail($id);

        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::query()
            ->with('gallery')
            ->findOrFail($id);

        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, $id)
    {
        $service = Service::query()->find($id);
        $serviceData = $request->only(['title', 'sub_title', 'short_description', 'long_description']);
        $mainImage  = $request->file('mainImage');


        if(!empty($mainImage)) {
            Storage::disk('public')->delete("services/main/{$service->main_image}");
            $ext = $mainImage->getClientOriginalExtension();
            $fileName = Str::random(32) . ".{$ext}";
            Storage::disk('public')->putFileAs("services/main/", $mainImage, $fileName);

            $serviceData = ['main_image' => $fileName] + $serviceData;
        }

        $service->update($serviceData);

        $files      = $request->file('gallery');

        if(!empty($files)) {
            foreach ($files as $file) {
                $ext = $file->getClientOriginalExtension();
                $fileName = Str::random(32) . ".{$ext}";
                ServiceImage::query()->create([
                    'service_id' => $id,
                    'file_name'  => $fileName
                ]);

                Storage::disk('public')->putFileAs("services/{$service->id}", $file, $fileName);
            }
        }

        return redirect()->route('services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::query()->findOrFail($id);

        Storage::disk('public')->deleteDirectory('services/' . $id);
        Storage::disk('public')->delete("services/main/{$service->main_image}");

        $service->delete();
        return response()->json(['success' => true]);
    }


    public function destroyImage($id)
    {
        $image = ServiceImage::query()->findOrFail($id);

        Storage::disk('public')->delete("services/{$image->service_id}/{$image->file_name}");

        $image->delete();
        return response()->json(['success' => true]);
    }


    public function sliderIndex($service)
    {
        $sliders = ServiceSlider::query()
            ->where('service_id', '=', $service)
            ->orderBy("order", "ASC")
            ->get();

        return view('services.slider.index', compact('sliders'));
    }



    public function sliderCreate()
    {
        return view('services.slider.create');
    }


    /**
     * @param Request $request
     * @param $location
     * @throws \Illuminate\Validation\ValidationException
     */
    public function sliderStore(Request $request, $service)
    {
        $this->validate($request, [
            'file' => 'required|array',
            'file.*' => 'image'
        ]);

        $files = $request->file('file');

        foreach ($files as $file) {
            $ext = $file->getClientOriginalExtension();
            $fileName = Str::random(32) . ".{$ext}";
            ServiceSlider::query()->create([
                'service_id' => $service,
                'file_name'  => $fileName
            ]);

            Storage::disk('public')->putFileAs("services/slider/{$service}", $file, $fileName);
        }

        return redirect()->route('services.slider', ['service' => $service]);
    }


    public function destroyImageSlider($id)
    {
        $slider = ServiceSlider::query()->find($id);
        Storage::delete('/public/services/slider/' . $slider->service_id . '/' . $slider->file_name);
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
            ServiceSlider::query()
                ->where("id", "=", $order)
                ->update([
                    "order" => $key
                ]);
        }
    }

    /**
     * @param Request $request
     */
    public function orderChangeGallery(Request $request)
    {
        $orders  = $request->get("orders");
        foreach ($orders as $key => $order) {
            ServiceImage::query()
                ->where("id", "=", $order)
                ->update([
                    "order" => $key
                ]);
        }
    }
}
