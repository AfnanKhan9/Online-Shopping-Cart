<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
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



    function checkout()
    {
        $category = Category::with('products')->get();
            $allCategories = Category::all(); // Add this line


        return view("website.checkout", compact('category','allCategories'));
    }

    function thankyou()
    {
        $category = Category::with('products')->get();
                    $allCategories = Category::all(); // Add this line


        return view('website.thankyou', compact('category','allCategories'));
    }
public function placeOrder(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'city' => 'required|string|max:100',
        'address' => 'required|string|max:500',
        'payment_method' => 'required|string',
    ]);

    $user = auth()->user();
    $orderNumber = 'ORD-' . date('YmdHis') . '-' . rand(1, 99);

    $cartItems = session('cart', []);
    if (empty($cartItems)) {
        return redirect()->route('shop')->with('error', 'Your cart is empty!');
    }

    // Calculate total
    $subtotal = 0;
    foreach ($cartItems as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
    $shipping = 200; // fixed shipping
    $totalAmount = $subtotal + $shipping;

    // Create order
    $order = \App\Models\Order::create([
        'user_id' => $user->id ?? null,
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'city' => $request->city,
        'address' => $request->address,
        'total_amount' => $totalAmount,
        'payment_method' => $request->payment_method,
        'status' => 'pending',
        'order_date' => now()->toDateString(),
        'order_number' => $orderNumber,
    ]);

    // Save order items
 $cart = session('cart');

foreach ($cart as $productId => $item) {
    $order->orderItems()->create([
        'product_id' => $productId, // ✔️ product id array key hai
        'quantity' => $item['quantity'],
        'price' => $item['price'],
    ]);
}


    // Clear cart session
    session()->forget('cart');

    return redirect()->route('thankyou')->with('success', 'Order placed successfully!');
}


}




