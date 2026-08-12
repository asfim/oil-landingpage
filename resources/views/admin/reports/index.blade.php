@extends('admin.layouts.app')

@section('title', 'Sales Report')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0 fw-bold">Sales Report</h5>
</div>

<!-- Filters -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('admin.reports.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label fw-semibold">Start Date</label>
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">End Date</label>
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-filter me-1"></i> Filter Report</button>
                @if(request('start_date') || request('end_date'))
                    <a href="{{ route('admin.reports.index') }}" class="btn btn-light border ms-2">Clear</a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-primary text-white h-100">
            <div class="card-body p-4 text-center">
                <i class="bi bi-wallet2 fs-1 mb-2"></i>
                <h6 class="text-uppercase fw-semibold" style="letter-spacing: 1px;">Total Revenue</h6>
                <h3 class="mb-0 fw-bold">৳{{ number_format($totalRevenue, 2) }}</h3>
                <small class="opacity-75">(Confirmed & Delivered)</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-dark text-white h-100">
            <div class="card-body p-4 text-center">
                <i class="bi bi-cart-check fs-1 mb-2"></i>
                <h6 class="text-uppercase fw-semibold" style="letter-spacing: 1px;">Total Orders</h6>
                <h3 class="mb-0 fw-bold">{{ number_format($totalOrders) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 border-0">
                <h6 class="mb-0 fw-bold text-center">Order Status Breakdown</h6>
            </div>
            <div class="card-body d-flex justify-content-around align-items-center text-center">
                <div>
                    <h4 class="mb-0 fw-bold text-success">{{ number_format($deliveredOrders) }}</h4>
                    <small class="text-muted fw-semibold">Delivered</small>
                </div>
                <div style="width:1px; height:40px; background:#e0e0e0;"></div>
                <div>
                    <h4 class="mb-0 fw-bold text-primary">{{ number_format($confirmedOrders) }}</h4>
                    <small class="text-muted fw-semibold">Confirmed</small>
                </div>
                <div style="width:1px; height:40px; background:#e0e0e0;"></div>
                <div>
                    <h4 class="mb-0 fw-bold text-warning">{{ number_format($pendingOrders) }}</h4>
                    <small class="text-muted fw-semibold">Pending</small>
                </div>
                <div style="width:1px; height:40px; background:#e0e0e0;"></div>
                <div>
                    <h4 class="mb-0 fw-bold text-danger">{{ number_format($cancelledOrders) }}</h4>
                    <small class="text-muted fw-semibold">Cancelled</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Top Products -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold">Top Selling Products</h6>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($topProducts as $tp)
                    <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <span class="text-truncate me-2" style="max-width: 200px;">{{ $tp->product_name }}</span>
                        <span class="badge bg-success rounded-pill px-3">{{ $tp->total_sold }} Sold</span>
                    </li>
                    @empty
                    <li class="list-group-item text-center py-4 text-muted">No sales data found.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <!-- Recent Orders in Report -->
    <div class="col-md-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold">Orders Overview</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Order ID</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td class="ps-3"><strong>#{{ $order->id }}</strong></td>
                                <td><small class="text-muted">{{ $order->created_at->format('d M Y') }}</small></td>
                                <td>{{ $order->customer_name }}</td>
                                <td><strong class="text-primary">৳{{ number_format($order->total_amount, 2) }}</strong></td>
                                <td>
                                    @if($order->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($order->status == 'confirmed')
                                        <span class="badge bg-primary">Confirmed</span>
                                    @elseif($order->status == 'delivered')
                                        <span class="badge bg-success">Delivered</span>
                                    @elseif($order->status == 'cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">No orders found for this period.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($orders->hasPages())
            <div class="card-footer bg-white border-0 pt-3">
                {{ $orders->withQueryString()->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
