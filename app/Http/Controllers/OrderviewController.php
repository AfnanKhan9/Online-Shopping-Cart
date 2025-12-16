<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderviewController extends Controller
{
    public function index()
    {
        $allCategories = Category::all();

        $orders = Order::where('user_id', auth()->id())
                       ->latest()
                       ->paginate(10);

        return view('website.orderview', compact('orders', 'allCategories'));
    }
}
