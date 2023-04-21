<?php

namespace App\Http\Controllers;

use App\Models\County;
use App\Models\Subcounty;
use App\Models\Ward;
use Illuminate\Http\Request;

class WardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wards = Ward::orderBy('created_at', 'desc')->get();
        return view('wards.index', compact('wards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $counties = County::all();
        $subcounties = Subcounty::all();
        return view('wards.create')->with([
            'counties' => $counties,
            'subcounties' => $subcounties
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
            'county_id' => 'required',
            'subcounty_id' => 'required',
            'ward_name' => 'required',
            'ward_location' => 'required'
        ]);

        Ward::create($request->all());
        return redirect()->route('wards.index')
            ->with('success', 'Ward Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function show(Ward $ward)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $counties = County::all();
        $subcounties = Subcounty::all();
        $ward = Ward::find($id);
        return view('wards.edit')->with([
            'counties' => $counties,
            'subcounties' => $subcounties
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([]);
        $ward = Ward::find($id);
        $ward->update($request->all());
        return redirect()->route('wards.index')
            ->with('success', 'Ward Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ward = Ward::find($id);
        $ward->delete();
        return redirect()->route('wards.index')
            ->with('success', 'Ward Deleted Successfully');
    }
}
