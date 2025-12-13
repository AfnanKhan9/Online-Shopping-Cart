@extends('layouts.dashmaster')

@section('order-content')
<div class="container mt-4">
    <h2>Orders</h2>

    <div class="row mb-3">
        <!-- Search Form -->
        <div class="col-md-6">
            <form action="{{ route('admin.orders.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, or order #" class="form-control" />
                <button class="btn btn-primary ms-2">Search</button>
            </form>
        </div>

        <!-- Status Filter -->
        <div class="col-md-3">
            <form action="{{ route('admin.orders.index') }}" method="GET">
                <select name="status" class="form-control" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request('status')=='processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped" {{ request('status')=='shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ request('status')=='delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ request('status')=='cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </form>
        </div>

        <!-- Export Buttons -->
        <div class="col-md-3 text-end">
            <a href="{{ route('admin.orders.export', ['format'=>'excel']) }}" class="btn btn-success btn-sm">Export Excel</a>
            <a href="{{ route('admin.orders.export', ['format'=>'pdf']) }}" class="btn btn-secondary btn-sm">Export PDF</a>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Order Number</th>
                <th>Customer</th>
                <th>Email</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Order Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->order_number }}</td>
                <td>{{ $order->user->name ?? $order->name }}</td>
                <td>{{ $order->user->email ?? $order->email }}</td>
                <td>${{ number_format($order->total_amount, 2) }}</td>
                <td>
                    <span class="badge 
                        @if($order->status=='pending') bg-warning 
                        @elseif($order->status=='processing') bg-info 
                        @elseif($order->status=='shipped') bg-primary 
                        @elseif($order->status=='delivered') bg-success 
                        @elseif($order->status=='cancelled') bg-danger 
                        @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td>{{ $order->order_date }}</td>
                <td>
                    <a href="{{ route('admin.orders.detail', $order->id) }}" class="btn btn-sm btn-primary">View</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No orders found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-3">
        {{ $orders->appends(request()->query())->links() }}
    </div>
</div>
@endsection
