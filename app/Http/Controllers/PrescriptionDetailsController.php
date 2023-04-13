<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\PrescriptionDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class PrescriptionDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $prescription = Prescription::all();
        $prescriptionDetails = PrescriptionDetail::all();
        return view('prescription-details.index', compact(['products', 'prescription', 'prescriptionDetails']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prescription.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PrescriptionDetail  $prescriptionDetail
     * @return \Illuminate\Http\Response
     */
    public function show(PrescriptionDetail $prescriptionDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PrescriptionDetail  $prescriptionDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(PrescriptionDetail $prescriptionDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PrescriptionDetail  $prescriptionDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PrescriptionDetail $prescriptionDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PrescriptionDetail  $prescriptionDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrescriptionDetail $prescriptionDetail)
    {
        //
    }
}
