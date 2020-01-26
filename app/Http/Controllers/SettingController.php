<?php

namespace App\Http\Controllers;

use App\Http\Requests\Setting\Update;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::query()->first();
        return view('settings.index', compact('settings'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, Setting $setting)
    {
        Setting::query()->first()->update($request->all());

        return redirect()->back()->with(['success' => true]);
    }
}
