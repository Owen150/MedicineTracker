<?php

namespace App\Http\Controllers;

use App\Models\Consolidate;
use App\Models\ConsolidatedPurchaseOrder;
use App\Models\Facility;
use App\Models\FinancialYear;
use App\Models\InvoiceProforma;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\Models\Supplier;
use App\Models\SupplierProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('purchase-order.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();

        $facilities = Facility::all();

        $finacialyears = FinancialYear::all();

        return view('purchase-order.create')->with([
            'products' => $products,
            'facilities'=> $facilities,
            'finacialyears' => $finacialyears
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
        DB::transaction(function () use($request) {
            $purchaseOrder = new PurchaseOrder();
            $purchaseOrder->purchase_order_num = $request->order_number;
            $purchaseOrder->facility_id = $request->facility;
            $purchaseOrder->finacial_year = $request->finacial_year;
            $purchaseOrder->delivery_note = $request->delivery_note;
            $purchaseOrder->total = $request->grand_total;
            $purchaseOrder->period = $request->period;
            
            $purchaseOrder->save();

         
            

            $detailsCount = count($request->product);

            for ($i=0; $i < $detailsCount; $i++) { 
                $purchaseOrderDetails = new PurchaseOrderDetail();
                $purchaseOrderDetails->order_id = $purchaseOrder->id;
                $purchaseOrderDetails->product_id = $request->product[$i];
                $purchaseOrderDetails->code = $request->code[$i];
                $purchaseOrderDetails->qty_ordered = $request->qty_ordered[$i];
                $purchaseOrderDetails->total = $request->rowtotal[$i];
                $purchaseOrderDetails->price = $request->price[$i];
                $purchaseOrderDetails->save();


            }

            

        }, 3);

        return redirect()->route('purchase-order.index')->with('success','Purchase order was created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchaseOrder = PurchaseOrder::find($id);

        return view('purchase-order.show')->with([
            'purchaseOrder' => $purchaseOrder
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * index data purchase order
     */
    public function indexData()
    {
        $purchaseOrders = PurchaseOrder::all();

        $purchaseOrdersArr = [];

        foreach ($purchaseOrders as $purchaseOrder) {
            $obj = new stdClass;
            $obj->id = $purchaseOrder->id;
            $obj->purchase_order_num = $purchaseOrder->purchase_order_num;
            $obj->facility = Facility::where('id','=',$purchaseOrder->facility_id)->first()->name;
            $obj->finacial_year = FinancialYear::where('id','=',$purchaseOrder->finacial_year)->first()->name;
            $obj->total = $purchaseOrder->total;
            $obj->sub_county = Facility::where('id','=',$purchaseOrder->facility_id)->first()->sub_county;
            $obj->ward = Facility::where('id','=',$purchaseOrder->facility_id)->first()->ward;
            $obj->location = Facility::where('id','=',$purchaseOrder->facility_id)->first()->location;
            $obj->status = $purchaseOrder->status;
            $obj->period = $purchaseOrder->period;

            array_push($purchaseOrdersArr, $obj);
        }

        return response($purchaseOrdersArr);
    }
    /**
     * get product price and code from supplier product table
    */
    public function getProdCodePrice(Request $request)
    {
        $request->validate([
            'supplier' => 'required',
            'product' => 'required'
        ]);

        $prodDetails = SupplierProduct::where('product_id','=', $request->product)->where('suplier_id','=',$request->supplier)->first();

        if ($prodDetails) {
            return response($prodDetails);
        };

    
    }


    /**
     * get order to be receieved
     */
    public function getOrder($id)
    {

        $order = PurchaseOrder::find($id);
        
        $purchaseOrder = PurchaseOrderDetail::all()->where('order_id', $order->id);
        // dd($order->purchase_order_num);

        $facilities = Facility::all();

        $supplier = Supplier::all();

        $finacialyears = FinancialYear::all();

        
        $products = Product::all();

        // return view ('purchase-order.received', compact(['order', 'facilities', 'supplier', 'products', 'finacialyears']));

        return view('purchase-order.received')->with([
            'order' => $order,
            'purchaseOrder' => $purchaseOrder,
            'facilities' => $facilities,
            'supplier' => $supplier,
            'finacialyears' => $finacialyears,
            'products' => $products
        ]);

        
    }


    /**
     * 
     * consolidate purchase order
     * 
     */
    public function consolidate(Request $request)
    {
        $request->validate([
            'period'=>'required'
        ]);

        $finacialYear = FinancialYear::orderBy('created_at', 'desc')->first();

        $purchaseOrders = PurchaseOrder::where('period','=',$request->period)->where('finacial_year','=',$finacialYear->id)->get();

        //dd($purchaseOrders);

        DB::transaction(function() use ($purchaseOrders, $finacialYear, $request){

    
            $consolidated = new InvoiceProforma();
            $consolidated->financial_year_id = $finacialYear->id;
            $consolidated->supplier_id = $request->supplier;
            $consolidated->period = $request->period;
            $consolidated->lpo = 'lpo';
            $consolidated->approved_for_supply = 0;
            $consolidated->approved_for_supply = 0;
            $consolidated->payment_status = 'Pending Payment';
            $consolidated->inv_num = $request->inv_number;
            
            $amt = 0;

            foreach ($purchaseOrders as $purchaseOrder) {
                $amt += $purchaseOrder->total;
            }
            $consolidated->amount = $amt;
            $consolidated->save();

            foreach ($purchaseOrders as $purchaseOrder) {
                $consolidatedOrder = new ConsolidatedPurchaseOrder();
                $consolidatedOrder->invoice_profoma_id = $consolidated->id;
                $consolidatedOrder->purchase_order_id = $purchaseOrder->id;
                $consolidatedOrder->save();
            }

        
        });


        return redirect()->back()->with('success', 'Requisitions successfully consolidated');

    }
}
