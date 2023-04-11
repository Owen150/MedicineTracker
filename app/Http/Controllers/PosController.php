<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\FacilityProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('pos', compact('products'));
    }

    public function search(Request $request)
    {
        $output = "";
        $products = Product::where('product_name', 'Like', '%' . $request->search . '%')->get();
        $facility = Facility::find(1);
        foreach ($products as $product) {
            $facilityProduct = FacilityProduct::where('product_id','=',$product->id)->first();
            $quantity = $facilityProduct->qty;
            $output .=
                '
                <div class="col-md-4 mb-2">
                <div class="product-panel bg-white overflow-hidden border-0 shadow-sm" onClick="addProductToTable(this)" data-price='.$product->price.' data-name='.$product->product_name.' data-available='.$product->quantity.'>
                    <div class="item-image position-relative overflow-hidden">
                        <img src="https://pharmacaredemo.bdtask-demo.com/pharmacare-9.4_demo/assets/dist/img/products/1613648757_2610e132926e221ae6a4.jpg" alt="" class="img-fluid">
                    </div>
                    <div class="panel-footer border-0 bg-white p-3">
                        <h6 class="item-details-title">'.$product->product_name.'</h6>
                    </div>
                </div>
                </div>';
        }

        return response($output);
    }

    public function posAllProducts(){
        $output = "";
        $products = Product::all()->take(10);
        $facility = Facility::find(1);

        foreach ($products as $product) {
            $facilityProduct = FacilityProduct::where('product_id','=',$product->id)->first();
            $quantity = $facilityProduct->qty;
            $output .=
                '
                <div class="col-md-4 mb-2">
                <div class="product-panel bg-white overflow-hidden border-0 shadow-sm" onClick="addProductToTable(this)" data-price='.$product->price.' data-name='.$product->product_name.' data-available='.$product->quantity.'>
                    <div class="item-image position-relative overflow-hidden">
                        <img src="https://pharmacaredemo.bdtask-demo.com/pharmacare-9.4_demo/assets/dist/img/products/1613648757_2610e132926e221ae6a4.jpg" alt="" class="img-fluid">
                    </div>
                    <div class="panel-footer border-0 bg-white p-3">
                        <h6 class="item-details-title">'.$product->product_name.'</h6>
                    </div>
                </div>
                </div>';
        }
        return response($output);

    }
}
