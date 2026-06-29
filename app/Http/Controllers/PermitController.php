<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Permit;

class PermitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $available = Permit::all();
        return response()->json([$available]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $permit = Validator::make($request->all(),[
            'permit_no'=>'required',
            'user_id'=>'required|exists:users,id',
            'park_id'=>'required|exists:parks,id',
            'visit_date'=>'required|date',
            'status'=>'required|in:pending,completed,rejected,used',
            'total_amount'=>'required'
        ]);

        if($permit->fails()){
            return response()->json(['error'=>$permit->errors()],403);
        }

        $permited = $permit->validated();

        Permit::create([

            'permit_no'=>$permited['permit_no'],
            'user_id'=>$permited['user_id'],
            'park_id'=>$permited['park_id'],
            'visit_date'=>$permited['visit_date'],
            'status'=>$permited['status'],
            'total_amount'=>$permited['total_amount']
      
        ]);
        return response()->json(['message'=>'you permission created successfully'], 201);
    
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
