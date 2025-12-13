@extends('layouts.dashmaster')

@section('order-detail-content')
    <div class="container mt-4">
        <h2>Order Details - {{ $order->order_number }}</h2>

        <div class="card mb-3">
            <div class="card-header">Customer Info</div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $order->name }}</p>
                <p><strong>Email:</strong> {{ $order->email }}</p>
                <p><strong>Phone:</strong> {{ $order->phone }}</p>
                <p><strong>City:</strong> {{ $order->city }}</p>
                <p><strong>Address:</strong> {{ $order->address }}</p>

            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Order Items</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                            <tr>
                                <td>{{ $item->product->name ?? 'Deleted Product' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h5 class="text-end">Total: ${{ number_format($order->total_amount, 2) }}</h5>
            </div>
        </div>

        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back to Orders</a>
    </div>
@endsection