<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseOrderDetail;
use Illuminate\Http\Request;

class PurchaseOrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseOrderDetails = PurchaseOrderDetail::all();
        $products = Product::all();
        return view('purchase-order-detail.index', compact(['purchaseOrderDetails', 'products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('purchase-order.index');
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
     * @param  \App\Models\PurchaseOrderDetail  $purchaseOrderDetail
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrderDetail $purchaseOrderDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrderDetail  $purchaseOrderDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrderDetail $purchaseOrderDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseOrderDetail  $purchaseOrderDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrderDetail $purchaseOrderDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrderDetail  $purchaseOrderDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrderDetail $purchaseOrderDetail)
    {
        //
    }
}
