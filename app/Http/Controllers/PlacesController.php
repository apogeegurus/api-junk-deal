<?php

namespace App\Http\Controllers;

use App\Http\Requests\Place\Store;
use App\Http\Requests\Place\Update;
use App\Models\Location;
use App\Models\Places;
use Illuminate\Http\Request;

class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            "location_id" => 'required|exists:locations,id'
        ]);

        $places = Places::query()
            ->select('places.id', 'places.name', 'places.address')
            ->where("location_id" , "=", $request->location_id)
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        return view('places.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = Location::query()->select("city", "id")->get();
        return view('places.create', compact("locations"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $data = $request->only(['name', 'address', 'url', 'phone', 'location_id']);
        Places::query()->create($data);
        return redirect()->route('places.index', ["location_id" => $request->location_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Places  $places
     * @return \Illuminate\Http\Response
     */
    public function show(Places $places)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Places  $place
     * @return \Illuminate\Http\Response
     */
    public function edit(Places $place)
    {
        $locations = Location::query()->select("city", "id")->get();
        return view('places.edit', compact('place', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Places  $place
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, Places $place)
    {
        $data = $request->only(['name', 'address', 'url', 'phone', 'location_id']);
        $place->update($data);

        return redirect()->route('places.index', ["location_id" => $request->location_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Places  $place
     * @return \Illuminate\Http\Response
     */
    public function destroy(Places $place)
    {
        $place->delete();
        return response()->json(['success' => true]);
    }
}
