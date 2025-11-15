<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(){
        return view ("website.home");
    }

    function shop(){
        return view ("website.shop");
    }

    function blog(){
        return view ("website.blog");
    }

    function contact(){
        return view ("website.contact");
    }
}
