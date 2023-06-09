<?php

namespace App\Http\Controllers;

use App\Models\FacilityProduct;
use Illuminate\Http\Request;

class FacilityProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facilityProducts = FacilityProduct::all();
        return view('facilityProducts.index', compact('facilityProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('facilityProducts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $facilityProducts = new FacilityProduct();
        $facilityProducts->product_id = $request->product_id;
        $facilityProducts->facility_id = $request->facility_id;
        $facilityProducts->quantity = $request->quantity;
        $facilityProducts->reorder_level = $request->reorder_level;
        
        $facilityProducts->save();

        return redirect('facilityProducts')->with('status', 'Facility Products profile created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FacilityProduct  $facilityProduct
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $facilityProducts = FacilityProduct::find($id);
        return view('facilityProducts.show', compact('facilityProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FacilityProduct  $facilityProduct
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $facilityProducts = FacilityProduct::find($id);
        return view('facilityProducts.edit', compact('facilityProducts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FacilityProduct  $facilityProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $facilityProducts = FacilityProduct::find($id);
        $facilityProducts->product_id = $request->product_id;
        $facilityProducts->facility_id = $request->facility_id;
        $facilityProducts->quantity = $request->quantity;
        $facilityProducts->reorder_level = $request->reorder_level;

        $facilityProducts->update();

        return redirect('facilityProducts')->with('status', 'Facility Products info updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FacilityProduct  $facilityProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FacilityProduct::find($id)->delete();
        return redirect()->back()->with('status', 'Facility Products deleted successfully');
    }
}
