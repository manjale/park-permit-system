<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use App\Models\Park;
use Illuminate\Http\Request;

class ParkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parks = Park::all();
        return response()->json(['message'=>$parks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validpark = Validator::make($request->all(),[
            'name'=>'required|string',
            'location'=>'required',
            'description'=>'required'
        ]);

        if($validpark->fails()){
            return response()->json(['error'=>$validpark->errors()],403);
        }

        $valid = $validpark->validated();

        $park = Park::create([
            'name'=>$valid['name'],
            'location'=>$valid['location'],
            'description'=>$valid['description']
        ]);

        return response()->json(['message'=>'park added succesfully',
        'park'=>$park]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Park $park)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Park $park)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Park $park)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Park $park)
    {
        //
    }
}
