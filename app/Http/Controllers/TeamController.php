<?php

namespace App\Http\Controllers;

use App\Http\Requests\Team\Store;
use App\Http\Requests\Team\Update;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::query()->paginate(20);
        return view('teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $data = $request->only(['name', 'position']);
        $avatar  = $request->file('avatar');
        $ext = $avatar->getClientOriginalExtension();
        $fileName = Str::random(32) . ".{$ext}";
        $avatar = Image::make($avatar)->fit(176, 220)->encode($ext);
        Storage::disk('public')->put("teams/members/{$fileName}", $avatar->__toString());

        $data = ['avatar' => $fileName] + $data;
        Team::query()->create($data);

        return redirect()->route('teams.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        return view('teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, Team $team)
    {
        $data = $request->only(['name', 'position']);
        $avatar  = $request->file('avatar');


        if(!empty($avatar)) {
            Storage::disk('public')->delete("teams/members/{$team->avatar}");
            $ext = $avatar->getClientOriginalExtension();
            $fileName = Str::random(32) . ".{$ext}";
            $avatar = Image::make($avatar)->fit(176, 220)->encode($ext);
            Storage::disk('public')->put("teams/members/$fileName", $avatar->__toString());

            $data = ['avatar' => $fileName] + $data;
        }

        $team->update($data);

        return redirect()->route('teams.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        Storage::disk('public')->delete("teams/members/{$team->avatar}");

        $team->delete();
        return response()->json(['success' => true]);
    }
}
