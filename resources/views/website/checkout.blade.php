@extends('Layouts.webmaster')

@section('checkout-content')

@php
    $cart = session('cart', []);
    if(empty($cart)){
        echo "<div class='container py-5'><div class='alert alert-warning'>Your cart is empty. <a href='".route('shop')."'>Go Shopping</a></div></div>";
        exit;
    }

    $subtotal = 0;
    foreach($cart as $item){
        $subtotal += $item['price'] * $item['quantity'];
    }
    $grandTotal = $subtotal + 200;
@endphp

<div class="container py-5">

    <h2 class="mb-4">Checkout</h2>

    <div class="row">

        <!-- Billing Details -->
        <div class="col-lg-8">

            <div class="card mb-4">
                <div class="card-header bg-dark text-white">Billing Details</div>
                <div class="card-body">
                    <form action="{{ route('userorders.store') }}" method="POST">
                        @csrf

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Full Name</label>
                                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Phone</label>
                                <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>City</label>
                                <input type="text" name="city" value="{{ old('city', auth()->user()->city ?? '') }}" class="form-control" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Address</label>
                                <textarea name="address" class="form-control" required>{{ old('address', auth()->user()->address) }}</textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Payment Method</label>
                                <select name="payment_method" class="form-control" required>
                                    <option value="cod">Cash On Delivery</option>
                                    <option value="card">Credit Card</option>
                                    <option value="bank">Bank Transfer</option>
                                </select>
                            </div>

                        </div>

                        <button class="btn btn-primary w-100 py-3 mt-3">Place Order</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-4">

            <div class="card">
                <div class="card-header bg-secondary text-white">Order Summary</div>
                <div class="card-body">
                    <ul class="list-group mb-3">

                        @foreach($cart as $item)
                        <li class="list-group-item d-flex justify-content-between">
                            {{ $item['name'] }} (x{{ $item['quantity'] }})
                            <span>Rs {{ $item['price'] * $item['quantity'] }}</span>
                        </li>
                        @endforeach

                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Subtotal</strong>
                            <strong>Rs {{ $subtotal }}</strong>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Shipping</strong>
                            <strong>Rs 200</strong>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Total</strong>
                            <strong>Rs {{ $grandTotal }}</strong>
                        </li>

                    </ul>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection
