@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Quick Stats -->
    <div class="col-md-3 mb-4">
        <a href="{{ route('admin.orders.index') }}" class="text-decoration-none">
            <div class="card bg-primary text-white h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-uppercase mb-2">Today's Sales</h6>
                    <h3 class="mb-0">৳ {{ number_format($todaySales, 2) }}</h3>
                    <small class="text-white-50">{{ $todayOrders }} Orders Today</small>
                </div>
            </div>
        </a>
    </div>
    
    <div class="col-md-3 mb-4">
        <a href="{{ route('admin.orders.index', ['status' => 'delivered']) }}" class="text-decoration-none">
            <div class="card bg-success text-white h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-uppercase mb-2">Total Sales</h6>
                    <h3 class="mb-0">৳ {{ number_format($totalSales, 2) }}</h3>
                    <small class="text-white-50">Lifetime Delivered Orders</small>
                </div>
            </div>
        </a>
    </div>
    
    <div class="col-md-3 mb-4">
        <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="text-decoration-none">
            <div class="card bg-warning text-dark h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-uppercase mb-2">Pending Orders</h6>
                    <h3 class="mb-0">{{ $pendingOrders }}</h3>
                    <small class="text-dark-50">Needs attention</small>
                </div>
            </div>
        </a>
    </div>
    
    <div class="col-md-3 mb-4">
        <a href="{{ route('admin.orders.index') }}" class="text-decoration-none">
            <div class="card bg-info text-white h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-uppercase mb-2">Total Orders</h6>
                    <h3 class="mb-0">{{ $totalOrders }}</h3>
                    <small class="text-white-50">All time orders</small>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <!-- Recent Orders -->
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Recent Orders</h6>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Phone</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>
                                    <strong>{{ $order->customer_name }}</strong><br>
                                    <small class="text-muted">{{ Str::limit($order->product_name, 30) }}</small>
                                </td>
                                <td>{{ $order->phone }}</td>
                                <td>৳ {{ number_format($order->total_amount, 0) }}</td>
                                <td>
                                    @if($order->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($order->status == 'confirmed')
                                        <span class="badge bg-primary">Confirmed</span>
                                    @elseif($order->status == 'processing')
                                        <span class="badge bg-info">Processing</span>
                                    @elseif($order->status == 'delivered')
                                        <span class="badge bg-success">Delivered</span>
                                    @elseif($order->status == 'cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                    @endif
                                </td>
                                <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-light border" title="View Details"><i class="bi bi-eye"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">No orders found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
