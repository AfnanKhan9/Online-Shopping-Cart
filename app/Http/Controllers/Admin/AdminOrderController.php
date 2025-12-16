<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrdersExport;
use PDF;

class AdminOrderController extends Controller
{
    /**
     * ===============================
     * ADMIN DASHBOARD SUMMARY
     * ===============================
     */
    public function dashboard()
    {
        return view('dashboard.order.dashboard', [
            'totalOrders'      => Order::count(),
            'pendingOrders'    => Order::where('status', 'pending')->count(),
            'processingOrders' => Order::where('status', 'processing')->count(),
            'shippedOrders'    => Order::where('status', 'shipped')->count(),
            'deliveredOrders'  => Order::where('status', 'delivered')->count(),
            'cancelledOrders'  => Order::where('status', 'cancelled')->count(),
            'todayOrders'      => Order::whereDate('created_at', now())->count(),
        ]);
    }

    /**
     * ===============================
     * ORDER LIST (SEARCH + FILTER)
     * ===============================
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $status = $request->status;

        $orders = Order::with('user')
            ->when($search, function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            })
            ->when($status, function ($q) use ($status) {
                $q->where('status', $status);
            })
            ->latest()
            ->paginate(10);

        return view('dashboard.order.order_list', compact('orders', 'search', 'status'));
    }

    /**
     * ===============================
     * ORDER DETAILS
     * ===============================
     */
    public function show($id)
    {
        $order = Order::with('user', 'orderItems.product')->findOrFail($id);
        return view('dashboard.order.order_detail', compact('order'));
    }

    /**
     * ===============================
     * UPDATE ORDER STATUS
     * ===============================
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Order status updated successfully');
    }

    /**
     * ===============================
     * EXPORT ORDERS (EXCEL / PDF)
     * ===============================
     */
    public function export(Request $request, $format)
    {
        $search = $request->search;
        $status = $request->status;

        $orders = Order::with('user')
            ->when($search, function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            })
            ->when($status, function ($q) use ($status) {
                $q->where('status', $status);
            })
            ->latest()
            ->get();

        // EXCEL EXPORT
        if ($format === 'excel') {
            return Excel::download(new OrdersExport($orders), 'orders.xlsx');
        }

        // PDF EXPORT
        if ($format === 'pdf') {
            $pdf = PDF::loadView('dashboard.order.order_pdf', compact('orders'));
            return $pdf->download('orders.pdf');
        }

        return back()->with('error', 'Invalid export format');
    }
}
