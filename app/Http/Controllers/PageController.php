<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomePageRequest;
use App\Models\HomePage;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $home = HomePage::query()->first();
        return view('pages.home', compact('home'));
    }

    public function homeSave(HomePageRequest $request)
    {
        HomePage::query()->first()->update($request->all());
        return redirect()->back()->with(['success' => true]);
    }
}
