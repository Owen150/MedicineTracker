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
            ->with('success', 'Sub-county Added Successfully');
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
    public function edit($id)
    {
        $counties = County::all();
        $subcounty = Subcounty::find($id);
        return view('subcounties.edit')->with([
            'counties' => $counties,
            'subcounty' => $subcounty
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcounty  $subcounty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([]);
        $subcounty = Subcounty::find($id);
        $subcounty->update($request->all());

        return redirect()->route('subcounties.index')
            ->with('success', 'Sub-county Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcounty  $subcounty
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcounty = Subcounty::find($id);
        $subcounty->delete();
        return redirect()->route('subcounties.index')
        ->with('success', 'Sub-county Deleted Successfully');
    }
}
