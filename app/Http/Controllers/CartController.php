<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // CART PAGE
    public function index()
    {
        
        $cart = session()->get('cart', []);
                $allCategories = Category::with('products')->get();
        return view('website.cart', compact('cart','allCategories'));
    }

    // ADD TO CART
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
 $category = Category::with('products')->get();
        $cart = session()->get('cart', []);

        // Pehle check kare product already cart me to nahi
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Product add ho raha hai cart me
            $cart[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "quantity" => 1,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product Cart me add hogaya!');
    }

    // UPDATE CART QUANTITY
    public function update(Request $request, $id)
    {
         $category = Category::with('products')->get();
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Cart update hogaya!');
    }

    // REMOVE ITEM
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item cart se remove hogaya!');
    }

    // CLEAR FULL CART
    public function clear()
    {
         $category = Category::with('products')->get();
        session()->forget('cart');
        return redirect()->back()->with('success', 'Cart empty hogaya!');
    }

    public function store(Request $request)
    {
         $category = Category::with('products')->get();
        $id = $request->product_id;
        return $this->add($request, $id);
    }

}
