<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\SupplierProductCatalogue;
use Illuminate\Http\Request;

class SupplierProductCatalogueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplierProductCatalogue = SupplierProductCatalogue::orderBy('created_at', 'desc')->get();
        $suppliers = Supplier::all();
        return view('supplier-product-catalogue.index', compact('supplierProductCatalogue', 'suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\SupplierProductCatalogue  $supplierProductCatalogue
     * @return \Illuminate\Http\Response
     */
    public function show(SupplierProductCatalogue $supplierProductCatalogue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupplierProductCatalogue  $supplierProductCatalogue
     * @return \Illuminate\Http\Response
     */
    public function edit(SupplierProductCatalogue $supplierProductCatalogue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SupplierProductCatalogue  $supplierProductCatalogue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupplierProductCatalogue $supplierProductCatalogue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupplierProductCatalogue  $supplierProductCatalogue
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplierProductCatalogue $supplierProductCatalogue)
    {
        //
    }
}
