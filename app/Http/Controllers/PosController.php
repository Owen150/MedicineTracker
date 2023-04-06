<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function searchProducts(Request $request){
        if (request('search')){
            $products = Product::where('product_name', 'like','%'.request('search').'%')->get();
        } 
        return response($products);
    }
}
