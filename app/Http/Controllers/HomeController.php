<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
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
}
