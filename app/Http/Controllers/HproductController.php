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
    $product = Product::where('slug', $slug)->firstOrFail();
    $allCategories = Category::all(); // Add this line

    return view('website.product_detail', compact('product','allCategories'));
}

public function shopByCategory($slug)
{
    $category = Category::where('slug', $slug)->firstOrFail();

    $products = Product::where('category_id', $category->id)->paginate(12);

    $allCategories = Category::all(); // For sidebar

    return view('website.shop', compact('products', 'allCategories', 'category'));
}
public function shop(Request $request)
{
    $allCategories = Category::all();

    $products = Product::with('category')
        ->when($request->category, function($query, $categoryName) {
            $cat = Category::where('name', $categoryName)->first();
            if ($cat) {
                $query->where('category_id', $cat->id);
            }
        })  
        ->paginate(12);

    return view('website.shop', [
        'products' => $products,
        'allCategories' => $allCategories,
        'selectedCategory' => $request->category
    ]);
}

}
