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

    public function searchProducts(Request $request)
    {
        $output = "";
        $products = Product::where('product_name', 'Like', '%' . $request->search . '%')->get();
        foreach ($products as $product) {
            $output .=
                '<tr>
                    <td>' . $product->product_name . '</td>
                </tr>';
        }

        return response($output);
    }
}
