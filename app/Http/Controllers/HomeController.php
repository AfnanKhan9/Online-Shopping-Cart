<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(){

        
        $products = Product::with('category')->get();
        $recentproducts = Product::with('category')->orderBy('id','desc')->get();
        $category = Category::with('products')->get();

        return view ("website.home",compact('products','recentproducts','category'));
    }

    function shop(){
        
         $products = Product::with('category')->paginate(10);

        return view ("website.shop",compact('products'));
    }

    function blog(){
        return view ("website.blog");
    }

    function contact(){
        return view ("website.contact");
    }
}
