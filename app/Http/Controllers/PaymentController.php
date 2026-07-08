<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Payment;
use App\Models\Permit;

class PaymentController extends Controller
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
          $payment = Validator::make($request->all(),[
            'permit_id'=>'required|exists:permits,id',
            //'amount'=>'required|numeric',
            //'status'=>'required|in:pending,paid,failed',
            //'reference_no'=>'required|string'

        ]);

        if($payment->fails()){
            return response()->json(["error"=>$payment->errors()], 422);
        }

         $paid = $payment->validated();

        $permit = Permit::findOrFail($paid['permit_id']);

        $referenceNo = 'PAY-' . now()->format('YmdHis');

       

        $payment= Payment::create([
            'permit_id'=>$permit->id,
            'amount'=>$permit->total_amount,
            'status'=>$paid['status'],
            'reference_no'=>$referenceNo,
        ]);

        return response()->json(['message'=>'payment made successfully',
        'payment'=>$payment
        ]);    }

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
