<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use app\Models\Feerule;

class FeeRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $fee = Validator::make($request->all(),[
            'park_id'=>'required|exists:parks,id',
            'visitor_type'=>'required',
            'amount'=>'required'

        ]);

        if($fee->fails()){
            return response()->json(['error'=>$fee->errors()], 403);
        }

        $feerule = $fee->validated();

        Feerule::create([
            'park_id'=>$feerule['park_id'],
            'visitor_type'=>$feerule['visitor_type'],
            'amount'=>$feerule['amount']
        ]);

        return response()->json(['message'=>'feerule created successfully'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
