<?php

namespace App\Http\Controllers;

use App\Models\County;
use App\Models\Subcounty;
use Illuminate\Http\Request;

class SubcountyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcounties = Subcounty::all();
        return view('subcounties.index', compact('subcounties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $counties = County::all();
        return view('subcounties.create')->with([
            'counties' => $counties
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
            'constituency_name' => 'required',
            'ward' => 'required'
        ]);

        Subcounty::create($request->all());
        return redirect()->route('subcounties.index')
            ->with('success', 'Sub-county Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subcounty  $subcounty
     * @return \Illuminate\Http\Response
     */
    public function show(Subcounty $subcounty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subcounty  $subcounty
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcounty $subcounty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcounty  $subcounty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcounty $subcounty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcounty  $subcounty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcounty $subcounty)
    {
        //
    }
}
