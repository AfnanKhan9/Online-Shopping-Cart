@extends('Layouts.webmaster')

@section('order-view')

    <div class="container-fluid py-4 bg-dark bg-opacity-75" style="min-height: 100vh;">

        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-100 rounded-circle p-3 me-3 shadow">
                        <i class="fas fa-receipt fa-2x text-dark"></i>
                    </div>
                    <div>
                        <h1 class="text-warning fw-bold display-6 mb-1">ORDER HISTORY</h1>
                        <p class="text-warning text-opacity-75 mb-0">View and manage all your orders</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card bg-dark border-warning border-2 h-100 shadow">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-warning text-opacity-90 mb-1">TOTAL ORDERS</p>
                                <h2 class="text-white fw-bold mb-0">{{ $orders->count() }}</h2>
                            </div>
                            <div class="bg-warning p-3 rounded-circle">
                                <i class="fas fa-shopping-bag fa-lg text-dark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-3 mb-3">
                <div class="card bg-dark border-warning border-2 h-100 shadow">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-warning text-opacity-90 mb-1">TOTAL SPENT</p>
                                <h2 class="text-white fw-bold mb-0">
    Rs {{ number_format($orders->sum('total_amount') + ($orders->count() * 200)) }}
</h2>

                            </div>
                            <div class="bg-warning bg-opacity-100 p-3 rounded-circle">
                                <i class="fas fa-coins fa-lg text-dark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card bg-dark border-warning border-2 h-100 shadow">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-warning text-opacity-90 mb-1">COMPLETED</p>
                                <h2 class="text-white fw-bold mb-0">{{ $orders->where('status', 'Delivered')->count() }}
                                </h2>
                            </div>
                            <div class="bg-warning bg-opacity-100 p-3 rounded-circle">
                                <i class="fas fa-check-circle fa-lg text-dark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card bg-dark border-warning border-2 h-100 shadow">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-warning text-opacity-90 mb-1">PENDING</p>
                                <h2 class="text-white fw-bold mb-0">{{ $orders->where('status', 'Pending')->count() }}</h2>
                            </div>
                            <div class="bg-warning bg-opacity-100 p-3 rounded-circle">
                                <i class="fas fa-clock fa-lg text-dark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="row">
            <div class="col-12">
                <div class="card border-warning border-2 bg-secondary bg-opacity-25 shadow-lg">
                    <div class="card-header bg-warning bg-opacity-100 py-3">
                        <h4 class="text-dark fw-bold mb-0">
                            <i class="fas fa-list-alt me-2"></i>ORDER DETAILS
                        </h4>
                    </div>

                    <div class="card-body p-0">
                        @if ($orders->count())
                            <div class="table-responsive">
                                <table class="table table-dark table-hover align-middle mb-0">
                                    <thead>
                                        <tr class="bg-warning bg-opacity-100">
                                            <th class="py-3 px-4 border-0 fw-bold text-dark">ORDER ID</th>
                                            <th class="py-3 px-4 border-0 fw-bold text-dark">TOTAL AMOUNT</th>
                                            <th class="py-3 px-4 border-0 fw-bold text-dark">STATUS</th>
                                            <th class="py-3 px-4 border-0 fw-bold text-dark">ORDER DATE</th>
                                            <th class="py-3 px-4 border-0 fw-bold text-dark">ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr class="border-bottom border-warning border-opacity-50">
                                                <td class="py-3 px-4">
                                                    <div class="d-flex align-items-center">
                                                        <div
                                                            class="bg-dark border border-warning border-opacity-50 rounded p-2 me-3">
                                                            <i class="fas fa-hashtag text-warning"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="text-white fw-bold mb-0">ORDER #{{ $order->id }}
                                                            </h6>
                                                            <small class="text-warning text-opacity-75">Reference:
                                                                ORD{{ $order->id }}{{ date('Y', strtotime($order->created_at)) }}</small>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="py-3 px-4">
                                                    <h5 class="text-warning fw-bold mb-0">
                                                        Rs {{ number_format($order->total_amount) }}
                                                    </h5>
                                                </td>

                                                <td class="py-3 px-4">
                                                    @if ($order->status === 'Pending')
                                                        <span
                                                            class="badge bg-warning bg-opacity-100 text-dark px-4 py-2 rounded-pill fw-bold">
                                                            <i class="fas fa-clock me-1"></i> PENDING
                                                        </span>
                                                    @elseif($order->status === 'Shipped')
                                                        <span
                                                            class="badge bg-warning bg-opacity-100 text-dark px-4 py-2 rounded-pill fw-bold">
                                                            <i class="fas fa-shipping-fast me-1"></i> SHIPPED
                                                        </span>
                                                    @else
                                                        <span
                                                            class="badge bg-warning bg-opacity-100 text-dark px-4 py-2 rounded-pill fw-bold">
                                                            <i class="fas fa-check-circle me-1"></i> DELIVERED
                                                        </span>
                                                    @endif
                                                </td>

                                                <td class="py-3 px-4">
                                                    <div class="d-flex align-items-center">
                                                        <div
                                                            class="bg-dark border border-warning border-opacity-50 rounded p-2 me-3">
                                                            <i class="far fa-calendar-alt text-warning"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="text-white fw-bold mb-0">
                                                                {{ $order->created_at->format('d M Y') }}
                                                            </h6>
                                                            <small class="text-warning text-opacity-75">
                                                                {{ $order->created_at->format('h:i A') }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="py-3 px-4">
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-outline-warning btn-sm">
                                                            <i class="fas fa-eye me-1"></i> View
                                                        </button>
                                                        <button type="button" class="btn btn-outline-warning btn-sm">
                                                            <i class="fas fa-print me-1"></i> Invoice
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            @if ($orders->hasPages())
                                <div class="card-footer bg-dark border-top border-warning border-opacity-50 py-3">
                                    <nav aria-label="Order pagination">
                                        <ul class="pagination justify-content-center mb-0">
                                            @if ($orders->onFirstPage())
                                                <li class="page-item disabled">
                                                    <span
                                                        class="page-link bg-dark border-warning border-opacity-50 text-warning">
                                                        <i class="fas fa-chevron-left"></i>
                                                    </span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link bg-dark border-warning border-opacity-50 text-warning"
                                                        href="{{ $orders->previousPageUrl() }}">
                                                        <i class="fas fa-chevron-left"></i>
                                                    </a>
                                                </li>
                                            @endif

                                            @foreach (range(1, $orders->lastPage()) as $page)
                                                @if ($page == $orders->currentPage())
                                                    <li class="page-item active">
                                                        <span
                                                            class="page-link bg-warning bg-opacity-100 border-warning text-dark">{{ $page }}</span>
                                                    </li>
                                                @else
                                                    <li class="page-item">
                                                        <a class="page-link bg-dark border-warning border-opacity-50 text-warning"
                                                            href="{{ $orders->url($page) }}">{{ $page }}</a>
                                                    </li>
                                                @endif
                                            @endforeach

                                            @if ($orders->hasMorePages())
                                                <li class="page-item">
                                                    <a class="page-link bg-dark border-warning border-opacity-50 text-warning"
                                                        href="{{ $orders->nextPageUrl() }}">
                                                        <i class="fas fa-chevron-right"></i>
                                                    </a>
                                                </li>
                                            @else
                                                <li class="page-item disabled">
                                                    <span
                                                        class="page-link bg-dark border-warning border-opacity-50 text-warning">
                                                        <i class="fas fa-chevron-right"></i>
                                                    </span>
                                                </li>
                                            @endif
                                        </ul>
                                    </nav>
                                </div>
                            @endif
                        @else
                            <!-- Empty State -->
                            <div class="text-center py-5">
                                <div class="bg-dark border border-warning border-opacity-50 rounded p-5 mx-auto"
                                    style="max-width: 500px;">
                                    <div class="display-1 text-warning mb-4">
                                        <i class="fas fa-box-open"></i>
                                    </div>
                                    <h3 class="text-warning fw-bold mb-3">No Orders Found</h3>
                                    <p class="text-warning text-opacity-75 mb-4">You haven't placed any orders yet. Start
                                        shopping to see your order history here!</p>
                                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                                        <a href="#" class="btn btn-warning text-dark fw-bold px-4 py-3">
                                            <i class="fas fa-shopping-cart me-2"></i>START SHOPPING
                                        </a>
                                        <a href="#" class="btn btn-outline-warning fw-bold px-4 py-3">
                                            <i class="fas fa-history me-2"></i>BROWSE PRODUCTS
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        @if ($orders->count())
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card border-warning border-2 bg-dark bg-opacity-25">
                        <div class="card-body">
                            <h5 class="text-warning mb-3">
                                <i class="fas fa-bolt me-2"></i>QUICK ACTIONS
                            </h5>
                            <div class="d-flex flex-wrap gap-3">
                                <button class="btn btn-outline-warning">
                                    <i class="fas fa-download me-2"></i>Export Orders
                                </button>
                                <button class="btn btn-outline-warning">
                                    <i class="fas fa-filter me-2"></i>Filter by Status
                                </button>
                                <button class="btn btn-outline-warning">
                                    <i class="fas fa-calendar-alt me-2"></i>Date Range
                                </button>
                                <button class="btn btn-outline-warning">
                                    <i class="fas fa-search me-2"></i>Search Orders
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Override Bootstrap colors for better yellow/black theme */
        .bg-warning {
            background-color: #FFC107 !important;
            /* Brighter but not too bright */
        }

        .text-warning {
            color: #FFC107 !important;
        }

        .border-warning {
            border-color: #FFC107 !important;
        }

        .btn-warning {
            background-color: #FFC107 !important;
            border-color: #FFC107 !important;
            color: #000000 !important;
        }

        .btn-outline-warning {
            color: #FFC107 !important;
            border-color: #FFC107 !important;
        }

        .btn-outline-warning:hover {
            background-color: #FFC107 !important;
            color: #000000 !important;
        }

        /* Enhanced table styling */
        .table-dark {
            --bs-table-bg: rgba(33, 37, 41, 0.7);
            /* Greyish dark */
            --bs-table-striped-bg: rgba(52, 58, 64, 0.7);
            --bs-table-hover-bg: rgba(73, 80, 87, 0.7);
            border-color: rgba(255, 193, 7, 0.5);
        }

        .table-dark tbody tr:hover {
            background-color: var(--bs-table-hover-bg) !important;
        }

        /* Card enhancements */
        .card {
            backdrop-filter: blur(10px);
        }

        /* Better status badges */
        .badge.bg-warning {
            transition: all 0.3s ease;
        }

        .badge.bg-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(255, 193, 7, 0.3);
        }

        /* Custom scrollbar */
        .table-responsive::-webkit-scrollbar {
            height: 8px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: rgba(33, 37, 41, 0.5);
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: #FFC107;
            border-radius: 4px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #FFD54F;
        }

        /* Pagination improvements */
        .page-link {
            transition: all 0.2s ease;
        }

        .page-link:hover {
            transform: scale(1.05);
        }

        /* Button group styling */
        .btn-group .btn-outline-warning {
            border-color: #FFC107 !important;
        }

        .btn-group .btn-outline-warning:not(:last-child) {
            border-right-color: rgba(255, 193, 7, 0.5) !important;
        }

        /* Status-specific colors */
        .badge.bg-warning[class*="SHIPPED"] {
            background-color: #FF9800 !important;
            /* Orange-yellow */
        }

        .badge.bg-warning[class*="DELIVERED"] {
            background-color: #4CAF50 !important;
            /* Green */
            color: white !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add animation to table rows
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateY(10px)';

                setTimeout(() => {
                    row.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                    row.style.opacity = '1';
                    row.style.transform = 'translateY(0)';
                }, index * 50);
            });

            // Status badge hover effects
            const badges = document.querySelectorAll('.badge');
            badges.forEach(badge => {
                badge.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.05)';
                });

                badge.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });

            // Button hover effects
            const warningButtons = document.querySelectorAll('.btn-warning, .btn-outline-warning');
            warningButtons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                    this.style.boxShadow = '0 4px 12px rgba(255, 193, 7, 0.4)';
                });

                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = 'none';
                });
            });

            // Quick action buttons functionality
            const quickActions = document.querySelectorAll('.btn-outline-warning');
            quickActions.forEach((button, index) => {
                button.addEventListener('click', function() {
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
                    this.disabled = true;

                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.disabled = false;

                        // Show Bootstrap toast notification
                        const toast = document.createElement('div');
                        toast.className =
                            'toast align-items-center text-white bg-warning border-0';
                        toast.setAttribute('role', 'alert');
                        toast.setAttribute('aria-live', 'assertive');
                        toast.setAttribute('aria-atomic', 'true');
                        toast.innerHTML = `
                        <div class="d-flex">
                            <div class="toast-body text-dark">
                                <i class="fas fa-check-circle me-2"></i>
                                Action completed successfully
                            </div>
                            <button type="button" class="btn-close btn-close-dark me-2 m-auto" data-bs-dismiss="toast"></button>
                        </div>
                    `;

                        const toastContainer = document.createElement('div');
                        toastContainer.className =
                            'toast-container position-fixed bottom-0 end-0 p-3';
                        toastContainer.appendChild(toast);
                        document.body.appendChild(toastContainer);

                        const bsToast = new bootstrap.Toast(toast);
                        bsToast.show();

                        setTimeout(() => {
                            toastContainer.remove();
                        }, 3000);
                    }, 1500);
                });
            });
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
