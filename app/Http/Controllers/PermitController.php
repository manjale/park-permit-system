<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Permit;
use App\Models\Payment;

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
            'status'=>'required|in:pending,completed,rejected,approved,used,',
            'total_amount'=>'required'
        ]);

        if($permit->fails()){
            return response()->json(['error'=>$permit->errors()],403);
        }

        $permited = $permit->validated();

       $perm = Permit::create([

            'permit_no'=>$permited['permit_no'],
            'user_id'=>$permited['user_id'],
            'park_id'=>$permited['park_id'],
            'visit_date'=>$permited['visit_date'],
            'status'=>$permited['status'],
            'total_amount'=>$permited['total_amount']
      
        ]);
        return response()->json(['message'=>'you permission created successfully',
        'permission'=>$perm
        ], 201);
    
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

    public function approve(Permit $permit){

    $payment = Payment::where('permit_id', $permit->id)->where('status','paid')->first();

    if(!$payment){
        return response()->json(['message'=>'permit can not be granted since you have not paid'],400);
    }

    $permit->update(['status'=>'approved']);

    return response()->json(['message'=>'permit approved successfully']);
    }

    public function reject(Permit $permit){
        if($permit->status !=='pending'){
            return response()->json(['message'=>'only pending permit can be processed']);
        }
        $permit->update(['status'=>'rejected']);
        return response()->json(['Message'=>'permit rejected successfully']);
    }

    public function verify(Request $request){
        $permits = Validator::make($request->all(),[
            'permit_no'=>'required|string'
        ]);
        if($permits->fails()){
            return response()->json(['error'=>$permits->errors()], 422);
        }

        $valid = $permits->validated();

        $permit = Permit::where('permit_no',$valid['permit_no'])->first();

        if(!$permit){
            return response()->json(['message'=>' permit is not found']);
        }

        if($permit->status ==='pending'){
            return response()->json(['message'=>'permit is in pending state'], 403);
        }
        if($permit->status ==='rejected'){
            return response()->json(['message'=>'permit is rejected'], 403);
        }
        if($permit->status ==='used'){
            return response()->json(['message'=>'permit is used'], 403);
        }
        if($permit->status ==='completed'){
            return response()->json(['message'=>'permit is completed'], 403);
        }
        return response()->json(['message'=>'permit verified successfully',
        'data'=>$permit
        
        ]);
    }
}
