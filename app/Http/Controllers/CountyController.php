<?php

namespace App\Http\Controllers;

use App\Models\County;
use Illuminate\Http\Request;

class CountyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $counties = County::all();
        return view('counties.index', compact('counties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('counties.create');
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
            'county_name' => 'required'
        ]);

        County::create($request->all());
        return redirect()->route('counties.index')
            ->with('success', 'County Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\County  $county
     * @return \Illuminate\Http\Response
     */
    public function show(County $county)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\County  $county
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $county = County::find($id);
        return view('counties.edit')->with([
            'county' => $county
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\County  $county
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'county_name' => 'required'
        ]);
        $county = County::find($id);
        $county->update($request->all());
        return redirect()->route('counties.index')
            ->with('success', 'County Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\County  $county
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $county = County::find($id);
        $county->delete();
        $county->update($request->all());
        return redirect()->route('counties.index')
            ->with('success', 'County Deleted Successfully');
    }
}
