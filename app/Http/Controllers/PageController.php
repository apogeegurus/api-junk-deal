<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomePageRequest;
use App\Models\HomePage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PageController extends Controller
{
    public function home()
    {
        $home = HomePage::query()->first();
        return view('pages.home', compact('home'));
    }

    public function homeSave(HomePageRequest $request)
    {
        $data = $request->all();

        $bannerFirst  = $request->file('banner_first');
        $ext          = $bannerFirst->getClientOriginalExtension();
        $fileNameBannerFirst = Str::random(32) . ".{$ext}";
        $bannerFirst  = Image::make($bannerFirst)->encode($ext)->__toString();
        Storage::disk('public')->put("home/banners/$fileNameBannerFirst", $bannerFirst);


        $bannerSecond  = $request->file('banner_second');
        $ext           = $bannerSecond->getClientOriginalExtension();
        $fileNameBannerSecond = Str::random(32) . ".{$ext}";
        $bannerSecond  = Image::make($bannerSecond)->encode($ext)->__toString();
        Storage::disk('public')->put("home/banners/$fileNameBannerSecond", $bannerSecond);

        $data = [
            'banner_second' => $fileNameBannerSecond,
            'banner_first' => $fileNameBannerFirst
        ] + $data;

        HomePage::query()->first()->update($data);
        return redirect()->back()->with(['success' => true]);
    }
}
