@extends('Layouts.webmaster')

@section('thankyou-content')

<div class="container py-5 text-center">
    <h1 class="text-success">Thank You!</h1>
    <p>Your order has been placed successfully.</p>
    <a href="{{ route('shop') }}" class="btn btn-primary mt-3">Continue Shopping</a>
</div>

@endsection
