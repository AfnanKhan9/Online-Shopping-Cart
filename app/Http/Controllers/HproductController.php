<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HproductController extends Controller
{
    //
    public function show($slug)
{
     $category = Category::with('products')->get();
    $product = Product::where('slug', $slug)->firstOrFail();
    return view('website.product_detail', compact('product','category'));
}
}
