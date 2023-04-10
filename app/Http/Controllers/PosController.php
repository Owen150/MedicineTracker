<?php

namespace App\Http\Controllers;

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
        foreach ($products as $product) {
            $output .=
                '<div>
                    ' . $product->product_name . '
                </div>';
        }

        return response($output);
    }
}
