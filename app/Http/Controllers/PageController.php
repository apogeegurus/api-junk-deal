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
        $bannerSecond  = $request->file('banner_second');
        $step1         = $request->file('step_1');
        $step2         = $request->file('step_2');
        $step3         = $request->file('step_3');
        $animationBack         = $request->file('animation_back');
        $animationFront         = $request->file('animation_front');
        $animationTruck         = $request->file('animation_truck');


        if(!empty($bannerFirst)) {
            $ext          = $bannerFirst->getClientOriginalExtension();
            $fileNameBannerFirst = Str::random(32) . ".{$ext}";
            Storage::disk('public')->putFileAs("home/banners", $bannerFirst, $fileNameBannerFirst);
            $data['banner_first'] = $fileNameBannerFirst;
        }


        if(!empty($bannerSecond)) {
            $ext = $bannerSecond->getClientOriginalExtension();
            $fileNameBannerSecond = Str::random(32) . ".{$ext}";
            Storage::disk('public')->putFileAs("home/banners", $bannerSecond, $fileNameBannerSecond);
            $data['banner_second'] = $fileNameBannerSecond;
        }


        if(!empty($step1)) {
            $ext = $step1->getClientOriginalExtension();
            $fileNameStep1 = Str::random(32) . ".{$ext}";
            Storage::disk('public')->putFileAs("home/steps", $step1, $fileNameStep1);
            $data['step_one'] = $fileNameStep1;
        }


        if(!empty($step2)) {
            $ext = $step2->getClientOriginalExtension();
            $fileNameStep2 = Str::random(32) . ".{$ext}";
            Storage::disk('public')->putFileAs("home/steps", $step2, $fileNameStep2);
            $data['step_two'] = $fileNameStep2;
        }

        if(!empty($step3)) {
            $ext = $step3->getClientOriginalExtension();
            $fileNameStep3 = Str::random(32) . ".{$ext}";
            Storage::disk('public')->putFileAs("home/steps", $step3, $fileNameStep3);
            $data['step_three'] = $fileNameStep3;
        }


        if(!empty($animationBack)) {
            $ext = $animationBack->getClientOriginalExtension();
            $fileNameAnimationBack = Str::random(32) . ".{$ext}";
            Storage::disk('public')->putFileAs("home/animations", $animationBack, $fileNameAnimationBack);
            $data['animation_back'] = $fileNameAnimationBack;
        }

        if(!empty($animationFront)) {
            $ext = $animationFront->getClientOriginalExtension();
            $fileNameAnimationFront = Str::random(32) . ".{$ext}";
            Storage::disk('public')->putFileAs("home/animations", $animationFront, $fileNameAnimationFront);
            $data['animation_front'] = $fileNameAnimationFront;
        }

        if(!empty($animationTruck)) {
            $ext = $animationTruck->getClientOriginalExtension();
            $fileNameAnimationTruck = Str::random(32) . ".{$ext}";
            Storage::disk('public')->putFileAs("home/animations", $animationTruck, $fileNameAnimationTruck);
            $data['animation_truck'] = $fileNameAnimationTruck;
        }

        HomePage::query()->first()->update($data);
        return redirect()->back()->with(['success' => true]);
    }
}
