@extends('admin.layouts.app')

@section('title', 'Manage Orders')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div class="d-flex align-items-center gap-3">
                <h6 class="mb-0 fw-bold fs-5">Orders</h6>
                
                <!-- Repeat / Popular Customers Button -->
                <a href="{{ route('admin.orders.index', ['filter' => 'repeat']) }}" class="btn btn-sm {{ request('filter') == 'repeat' ? 'btn-danger' : 'btn-outline-danger' }} fw-semibold">
                    <i class="bi bi-people-fill me-1"></i> Repeat Customers ({{ $repeatCount }})
                </a>
            </div>

            <!-- Status Filter Pills -->
            <div class="nav nav-pills gap-1">
                <a href="{{ route('admin.orders.index', ['status' => 'all']) }}" class="nav-link btn-sm {{ !request('filter') && (!request('status') || request('status') == 'all') ? 'active bg-dark' : 'bg-light text-dark' }}">
                    All Orders
                </a>
                <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="nav-link btn-sm {{ request('status') == 'pending' ? 'active bg-warning text-dark' : 'bg-light text-dark' }}">
                    Pending
                </a>
                <a href="{{ route('admin.orders.index', ['status' => 'confirmed']) }}" class="nav-link btn-sm {{ request('status') == 'confirmed' ? 'active bg-primary' : 'bg-light text-dark' }}">
                    Confirmed
                </a>
                <a href="{{ route('admin.orders.index', ['status' => 'delivered']) }}" class="nav-link btn-sm {{ request('status') == 'delivered' ? 'active bg-success' : 'bg-light text-dark' }}">
                    Delivered
                </a>
                <a href="{{ route('admin.orders.index', ['status' => 'cancelled']) }}" class="nav-link btn-sm {{ request('status') == 'cancelled' ? 'active bg-danger' : 'bg-light text-dark' }}">
                    Cancelled
                </a>
            </div>
        </div>
    </div>
    <div class="card-body p-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="ordersTable">
                <thead class="table-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Products</th>
                        <th>Total Amount</th>
                        <th style="min-width: 140px;">Status</th>
                        <th>Date</th>
                        <th style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td><strong>#{{ $order->id }}</strong></td>
                        <td>
                            <strong class="d-block">{{ $order->customer_name }}</strong>
                        </td>
                        <td>
                            <a href="tel:{{ $order->phone }}" class="text-decoration-none text-dark fw-medium">
                                <i class="bi bi-telephone text-primary me-1"></i>{{ $order->phone }}
                            </a>
                        </td>
                        <td style="max-width: 200px;">
                            <small class="text-muted text-truncate d-block" title="{{ $order->address }}">{{ $order->address }}</small>
                        </td>
                        <td>
                            <small class="fw-semibold">{{ Str::limit($order->product_name, 35) }}</small>
                            <div class="text-muted" style="font-size:11px;">Qty: {{ $order->quantity }}</div>
                        </td>
                        <td>
                            <strong class="text-primary">৳{{ number_format($order->total_amount, 2) }}</strong>
                            <div class="text-muted" style="font-size:11px;">Delivery: ৳{{ number_format($order->delivery_charge, 2) }}</div>
                        </td>
                        <td>
                            <!-- Inline Instant Status Update Dropdown -->
                            <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-select form-select-sm border-0 fw-semibold {{ $order->status == 'pending' ? 'bg-warning text-dark' : ($order->status == 'confirmed' ? 'bg-primary text-white' : ($order->status == 'delivered' ? 'bg-success text-white' : ($order->status == 'cancelled' ? 'bg-danger text-white' : 'bg-secondary text-white'))) }}" style="width: 125px;" onchange="this.form.submit()">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <small class="text-muted">{{ $order->created_at->format('d M Y, h:i A') }}</small>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-light border" title="View Full Details">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-light border text-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                            No orders found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
<style>
    /* Slight tweak to ensure datatables look good */
    div.dataTables_wrapper div.dataTables_length select { width: auto; display: inline-block; }
    .dt-buttons { margin-bottom: 15px; }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#ordersTable').DataTable({
            "order": [[ 0, "desc" ]],
            "pageLength": 25,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "language": {
                "emptyTable": "No orders found."
            },
            "dom": "<'row mb-2'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                   "<'row mb-2'<'col-sm-12'B>>" +
                   "<'row'<'col-sm-12'tr>>" +
                   "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "buttons": [
                { extend: 'copy', className: 'btn btn-sm btn-light border' },
                { extend: 'csv', className: 'btn btn-sm btn-light border' },
                { extend: 'excel', className: 'btn btn-sm btn-light border' },
                { extend: 'pdf', className: 'btn btn-sm btn-light border' },
                { extend: 'print', className: 'btn btn-sm btn-light border' }
            ]
        });
    });
</script>
@endpush
