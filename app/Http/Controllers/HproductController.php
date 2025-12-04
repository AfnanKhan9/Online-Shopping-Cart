<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HproductController extends Controller
{
    //
    public function show($slug)
{
    $product = Product::where('slug', $slug)->firstOrFail();
    return view('website.product_detail', compact('product'));
}
}
