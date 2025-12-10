<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function store(Request $request)
    {
        // Ensure user is logged in
        $user = Auth::user();
        // dd($user);
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to place order.');
        }

        // Cart check
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty!');
        }

        // Validate billing info from form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:50',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'payment_method' => 'required|string|in:cod,credit_card,cheque,vpp',

        ]);

        // Calculate totals
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $total_amount = $subtotal + 200; // fixed shipping


        // Create order with user submitted billing info
        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => $total_amount,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'order_date' => now(),
            'order_number' => 'ORD-' . date('YmdHis') . '-' . uniqid(), // generate unique order_number before insert

        ]);

        $order->order_number = 'ORD-' . date('YmdHis') . "-" . $order->id;
        $order->save();

        // Insert order items
        foreach ($cart as $product_id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product_id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Clear cart
        session()->forget('cart');

        // Redirect to thankyou page
        return redirect()->route('thankyou')->with('success', 'Order successfully placed!');
    }
}
