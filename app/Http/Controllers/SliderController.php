<?php

namespace App\Http\Controllers;

use App\Http\Requests\Place\Update;
use App\Http\Requests\Slider\Create;
use App\Models\Location;
use App\Models\Places;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::query()->get();
        return view('slider.index', compact('sliders'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        Storage::delete('/public/sliders/' . $slider->file_name);
        $file = $request->file('file');
        $ext  = $file->getClientOriginalExtension();
        $fileName = Str::random(32) . ".{$ext}";

        Storage::disk('public')->putFileAs("sliders", $file, $fileName);
        $slider->update(['file_name' => $fileName]);

        return redirect()->route('sliders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Create $request)
    {
        $file = $request->file('file');
        $ext  = $file->getClientOriginalExtension();
        $fileName = Str::random(32) . ".{$ext}";

        Storage::disk('public')->putFileAs("sliders", $file, $fileName);
        Slider::query()->create(['file_name' => $fileName]);

        return redirect()->route('sliders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        Storage::delete('/public/sliders/' . $slider->file_name);
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
            Slider::query()
                ->where("id", "=", $order)
                ->update([
                    "order" => $key
                ]);
        }
    }
}
