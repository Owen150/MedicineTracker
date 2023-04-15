<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prescriptions = Prescription::orderBy('created_at', 'desc')->get();
        $products = Product::all();
        return view('prescription.index', compact('prescriptions','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $users = User::all();
        return view('prescription.create')->with([
            'products' => $products,
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'patient_number' => 'required',
            'patient_name' => 'required',
            'patient_address' => 'required',
            'doctor' => 'required',
            'prescription_date' => 'required',
            'prescription_cost' => 'required',
        ]);

        Prescription::create($request->all());

        return redirect()->route('prescription.index')
            ->with('success', 'Prescription Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prescription = Prescription::find($id);
        return view('prescription.show', compact('prescription'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::all();
        $prescription = Prescription::find($id);
        return view('prescription.edit')->with([
            'products' => $products,
            'prescription' => $prescription,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([]);
        $prescription = Prescription::find($id);
        $prescription->update($request->all());
        return redirect()->route('prescription.index')
            ->with('success', 'Prescription Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prescription = Prescription::find($id);
        $prescription->delete();
        return redirect()->route('prescription.index')
            ->with('success', 'Prescription Deleted Successfully');
    }
}
