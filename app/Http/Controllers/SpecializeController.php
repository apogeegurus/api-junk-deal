<?php

namespace App\Http\Controllers;

use App\Http\Requests\Specialize\Store;
use App\Http\Requests\Specialize\Update;
use App\Models\Specialize;
use Illuminate\Http\Request;

class SpecializeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specializes = Specialize::query()->orderBy("order", 'ASC')->get();
        return view('specializes.index', compact('specializes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('specializes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $data = $request->only(['name']);
        Specialize::query()->create($data);

        return redirect()->route('specializes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Specialize $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Specialize $specialize)
    {
        return view('specializes.edit', compact('specialize'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, Specialize $specialize)
    {
        $data = $request->only(['name']);

        $specialize->update($data);

        return redirect()->route('specializes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialize $specialize)
    {
        $specialize->delete();
        return response()->json(['success' => true]);
    }


    /**
     * @param Request $request
     */
    public function orderChange(Request $request)
    {
        $orders  = $request->get("orders");
        foreach ($orders as $key => $order) {
            Specialize::query()
                ->where("id", "=", $order)
                ->update([
                    "order" => $key
                ]);
        }
    }
}
