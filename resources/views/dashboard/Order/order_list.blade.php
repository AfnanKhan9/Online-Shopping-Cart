@extends('layouts.dashmaster')

@section('order-content')
<div class="container mt-4">
    <h2>Orders</h2>

    <div class="row mb-3">
        <!-- Search -->
        <div class="col-md-6">
            <form action="{{ route('admin.orders.index') }}" method="GET" class="d-flex">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Search by name, email, or order #"
                       class="form-control">
                <button class="btn btn-primary ms-2">Search</button>
            </form>
        </div>

        <!-- Status Filter -->
        <div class="col-md-3">
            <form action="{{ route('admin.orders.index') }}" method="GET">
                <select name="status" class="form-control" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    @foreach(['pending','processing','shipped','delivered','cancelled'] as $st)
                        <option value="{{ $st }}" {{ request('status')==$st ? 'selected' : '' }}>
                            {{ ucfirst($st) }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <!-- Export -->
        <div class="col-md-3 text-end">
            <a href="{{ route('admin.orders.export',['format'=>'excel'] + request()->query()) }}"
               class="btn btn-success btn-sm">Export Excel</a>
            <a href="{{ route('admin.orders.export',['format'=>'pdf'] + request()->query()) }}"
               class="btn btn-secondary btn-sm">Export PDF</a>
        </div>
    </div>

    <table class="table table-bordered table-striped align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Order #</th>
                <th>Customer</th>
                <th>Email</th>
                <th>Total</th>
                <th>Status</th>
                <th>Order Date</th>
                <th width="120">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->order_number }}</td>
                <td>{{ $order->user->name ?? $order->name }}</td>
                <td>{{ $order->user->email ?? $order->email }}</td>
                <td>${{ number_format($order->total_amount,2) }}</td>

                <!-- STATUS CHANGE (FINAL FIX) -->
                <td>
                    <form action="{{ route('admin.orders.updateStatus',$order->id) }}"
                          method="POST">
                        @csrf
                        @method('PATCH')

                        <select name="status"
                                class="form-select form-select-sm"
                                onchange="this.form.submit()">
                            @foreach(['pending','processing','shipped','delivered','cancelled'] as $st)
                                <option value="{{ $st }}"
                                    {{ $order->status==$st ? 'selected' : '' }}>
                                    {{ ucfirst($st) }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </td>

                <td>{{ $order->order_date }}</td>

                <td>
                    <a href="{{ route('admin.orders.detail',$order->id) }}"
                       class="btn btn-sm btn-primary">
                        View
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No orders found</td>
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
