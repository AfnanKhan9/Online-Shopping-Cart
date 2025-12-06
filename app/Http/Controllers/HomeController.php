<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
<<<<<<< HEAD
// HomeController.php
public function index()
{
    $products = Product::latest()->take(3)->get();
    $recentProducts = Product::latest()->take(3)->get();
    $categories = Category::all(); // fetch all categories

    return view('website.home', [
        'products' => $products,
        'recentproducts' => $recentProducts,
        'category' => $categories,
        'allCategories' => $categories 
    ]);
}

 function shop(Request $request)
{
    $allCategories = Category::all();

    $products = Product::with('category')
        ->when($request->category, function ($query) use ($request) {
            return $query->whereHas('category', function ($q) use ($request) {
                $q->where('name', $request->category);
            });
        })
        ->paginate(12);

    return view("website.shop", [
        'products' => $products,
        'allCategories' => $allCategories
    ]);
}


    function blog(){
       $allCategories = Category::all(); // Add this line
        return view("website.blog",compact('allCategories'));
    }



public function contact()
{
    $allCategories = Category::all(); // Add this line
    return view('website.contact', compact('allCategories'));
}

}

=======
    function index()
    {


        $products = Product::with('category')->get();
        $recentproducts = Product::with('category')->orderBy('id', 'desc')->get();
        $category = Category::with('products')->get();

        return view("website.home", compact('products', 'recentproducts', 'category'));
    }

    function shop()
    {
        $category = Category::with('products')->get();
        $products = Product::with('category')->paginate(10);

        return view("website.shop", compact('products', 'category'));
    }
>>>>>>> 5d4ec378f4b49b14251f39570b748ea4dcf80c18

    function blog()
    {
        $category = Category::with('products')->get();

        return view("website.blog", compact('category'));
    }

    function contact()
    {
        $category = Category::with('products')->get();
        return view("website.contact", compact('category'));
    }

    function checkout()
    {
        $category = Category::with('products')->get();

        return view("website.checkout", compact('category'));
    }

    function thankyou()
    {
        $category = Category::with('products')->get();

        return view('website.thankyou', compact('category'));
    }

