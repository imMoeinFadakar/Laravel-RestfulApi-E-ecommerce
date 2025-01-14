<?php

namespace App\Http\Controllers;

use App\Http\Requests\RollRequest;
use App\Models\rolls;
use Illuminate\Http\Request;

class RoleController extends apiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RollRequest $request)
    {
        //

        $roll = rolls::query()->create([

            "title" => $request->title,

        ]);

        $roll->permissions()->attach($request->permissions);

        return $this->successResponse($roll->title,'Role createdd succesfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        // $roll = rolls::query()->update([

        //     "title" => $request->title,

        // ]);

        // $roll->permissions()->sync($request->permissions);

        // return $this->successResponse($roll->title,'Role updated succesfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
