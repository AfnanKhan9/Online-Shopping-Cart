<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Maatwebsite\Excel\Facades\Excel; // Excel export
use PDF; // PDF export

class AdminOrderController extends Controller
{
    /**
     * Dashboard summary
     */
    public function dashboard()
    {
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        $processingOrders = Order::where('status', 'processing')->count();
        $shippedOrders = Order::where('status', 'shipped')->count();
        $deliveredOrders = Order::where('status', 'delivered')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();
        $todayOrders = Order::whereDate('created_at', now()->toDateString())->count();

        return view('dashboard.order.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'processingOrders',
            'shippedOrders',
            'deliveredOrders',
            'cancelledOrders',
            'todayOrders'
        ));
    }

    /**
     * List all orders with search, status filter & pagination
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $orders = Order::with('user', 'orderItems.product')
            ->when($search, function ($query, $search) {
                $query->where('order_number', 'like', "%$search%")
                      ->orWhere('name', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%");
            })
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboard.order.order_list', compact('orders', 'search', 'status'));
    }

    /**
     * Show single order details
     */
    public function show($id)
    {
        $order = Order::with('user', 'orderItems.product')->findOrFail($id);

        return view('dashboard.order.order_detail', compact('order'));
    }

    /**
     * Export orders to Excel or PDF
     */
    public function export(Request $request, $format)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $orders = Order::with('user', 'orderItems.product')
            ->when($search, function ($query, $search) {
                $query->where('order_number', 'like', "%$search%")
                      ->orWhere('name', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%");
            })
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        if ($format === 'excel') {
            return Excel::download(new \App\Exports\OrdersExport($orders), 'orders.xlsx');
        }

        if ($format === 'pdf') {
            $pdf = PDF::loadView('dashboard.order.order_pdf', compact('orders'));
            return $pdf->download('orders.pdf');
        }

        return redirect()->back()->with('error', 'Invalid export format');
    }

    /**
     * Update order status from detail page (optional)
     */
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }
}
