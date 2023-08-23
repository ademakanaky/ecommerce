<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('products.index', compact('products'));
    }

    public function show(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        return view('products.show', compact('product'));
    }
}
