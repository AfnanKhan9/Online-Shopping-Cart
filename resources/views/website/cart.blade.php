@extends('layouts.webmaster')

@section('cart-content')

@php 
    $cart = session('cart', []);
    $subtotal = 0;
@endphp

<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">

        <!-- CART TABLE -->
        <div class="col-lg-8 table-responsive mb-5">

            @if(count($cart) == 0)
                <h3 class="text-center py-5">🛒 Your Cart is Empty</h3>
            @else

            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>

                <tbody class="align-middle">

                    @foreach($cart as $id => $item)

                        @php
                            $lineTotal = $item['price'] * $item['quantity'];
                            $subtotal += $lineTotal;
                        @endphp

                        <tr>
                            <td class="align-middle">
                                <img src="{{ asset('uploads/' . $item['image']) }}" 
                                     alt="" style="width: 50px;">
                                {{ $item['name'] }}
                            </td>

                            <td class="align-middle">Rs {{ $item['price'] }}</td>

                            <td class="align-middle">

                                <!-- AUTO UPDATE QUANTITY FORM -->
                                <form action="{{ route('cart.update', $id) }}" method="POST">
                                    @csrf

                                    <div class="input-group quantity mx-auto" style="width: 110px;">

                                        <!-- MINUS BUTTON -->
                                        <button class="btn btn-sm btn-primary"
                                            onclick="event.preventDefault(); 
                                            let input = this.parentNode.querySelector('input');
                                            if (parseInt(input.value) > 1) {
                                                input.value = parseInt(input.value) - 1;
                                                this.closest('form').submit();
                                            }">
                                            <i class="fa fa-minus"></i>
                                        </button>

                                        <input type="text" readonly name="quantity"
                                            class="form-control form-control-sm bg-secondary border-0 text-center"
                                            value="{{ $item['quantity'] }}">

                                        <!-- PLUS BUTTON -->
                                        <button class="btn btn-sm btn-primary"
                                            onclick="event.preventDefault(); 
                                            let input = this.parentNode.querySelector('input');
                                            input.value = parseInt(input.value) + 1;
                                            this.closest('form').submit();">
                                            <i class="fa fa-plus"></i>
                                        </button>

                                    </div>

                                </form>
                            </td>

                            <td class="align-middle">Rs {{ $lineTotal }}</td>

                            <td class="align-middle">

                                <!-- REMOVE FROM CART -->
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>

            @endif

        </div>

        <!-- SUMMARY -->
        <div class="col-lg-4">

            @if(count($cart))

            <h5 class="section-title position-relative text-uppercase mb-3">
                <span class="bg-secondary pr-3">Cart Summary</span>
            </h5>

            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">

                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6>Rs {{ $subtotal }}</h6>
                    </div>

                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">Rs 200</h6>
                    </div>

                </div>

                <div class="pt-2">
                    @php
                        $grandTotal = $subtotal + 200;
                    @endphp

                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5>Rs {{ $grandTotal }}</h5>
                    </div>

                    <a href="{{ route('checkout') }}" 
                       class="btn btn-block btn-primary font-weight-bold my-3 py-3">
                        Proceed To Checkout
                    </a>

                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        <button class="btn btn-danger w-100 py-2">Clear Cart</button>
                    </form>
                </div>

            </div>

            @endif

        </div>

    </div>
</div>
<!-- Cart End -->

@endsection
