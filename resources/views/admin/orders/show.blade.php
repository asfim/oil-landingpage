@extends('admin.layouts.app')

@section('title', 'Order Details #' . $order->id)

@section('content')
<div class="mb-3 d-flex justify-content-between align-items-center">
    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Back to Orders
    </a>
    <div class="d-flex gap-2">
        <button onclick="window.print();" class="btn btn-sm btn-outline-dark">
            <i class="bi bi-printer me-1"></i> Print Invoice
        </button>
    </div>
</div>

<div class="row">
    <!-- Main Order Details -->
    <div class="col-lg-8 mb-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Order Summary #{{ $order->id }}</h6>
                <span class="text-muted" style="font-size: 13px;">Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Product Details</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($order->items && $order->items->count() > 0)
                                @foreach($order->items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($item->product && $item->product->img)
                                                <img src="{{ asset($item->product->img) }}" alt="" style="width:48px;height:48px;object-fit:cover;border-radius:6px;" class="me-3">
                                            @endif
                                            <div>
                                                <strong class="d-block">{{ $item->product_name }}</strong>
                                                @if($item->product)
                                                    <small class="text-muted">Code / ID: #{{ $item->product->id }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">৳{{ number_format($item->product_price, 2) }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end fw-semibold">৳{{ number_format($item->subtotal, 2) }}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        <strong>{{ $order->product_name }}</strong>
                                    </td>
                                    <td class="text-center">৳{{ number_format($order->unit_price, 2) }}</td>
                                    <td class="text-center">{{ $order->quantity }}</td>
                                    <td class="text-end fw-semibold">৳{{ number_format($order->unit_price * $order->quantity, 2) }}</td>
                                </tr>
                            @endif
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end fw-semibold">Subtotal:</td>
                                <td class="text-end fw-semibold">৳{{ number_format($order->unit_price * $order->quantity, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end fw-semibold">Delivery Charge:</td>
                                <td class="text-end fw-semibold">৳{{ number_format($order->delivery_charge, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end fw-bold fs-6">Grand Total:</td>
                                <td class="text-end fw-bold fs-5 text-primary">৳{{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        @if($order->note)
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="bi bi-sticky me-1 text-warning"></i> Admin Notes</h6>
            </div>
            <div class="card-body">
                <p class="mb-0 text-muted">{{ $order->note }}</p>
            </div>
        </div>
        @endif
    </div>

    <!-- Right Sidebar (Customer Info & Status Update) -->
    <div class="col-lg-4">
        <!-- Status Update Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="bi bi-flag me-1"></i> Order Status</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label text-muted small text-uppercase">Current Status</label>
                    <div>
                        @if($order->status == 'pending')
                            <span class="badge bg-warning text-dark fs-6 px-3 py-2">Pending</span>
                        @elseif($order->status == 'confirmed')
                            <span class="badge bg-primary fs-6 px-3 py-2">Confirmed</span>
                        @elseif($order->status == 'processing')
                            <span class="badge bg-info fs-6 px-3 py-2">Processing</span>
                        @elseif($order->status == 'delivered')
                            <span class="badge bg-success fs-6 px-3 py-2">Delivered</span>
                        @elseif($order->status == 'cancelled')
                            <span class="badge bg-danger fs-6 px-3 py-2">Cancelled</span>
                        @else
                            <span class="badge bg-secondary fs-6 px-3 py-2">{{ ucfirst($order->status) }}</span>
                        @endif
                    </div>
                </div>

                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Preserve existing fields -->
                    <input type="hidden" name="customer_name" value="{{ $order->customer_name }}">
                    <input type="hidden" name="phone" value="{{ $order->phone }}">
                    <input type="hidden" name="address" value="{{ $order->address }}">
                    <input type="hidden" name="note" value="{{ $order->note }}">

                    <div class="mb-3">
                        <label for="order_status" class="form-label fw-semibold">Change Status</label>
                        <select name="status" id="order_status" class="form-select">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-check-circle me-1"></i> Update Status
                    </button>
                </form>
            </div>
        </div>

        <!-- Customer Information Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="bi bi-person me-1"></i> Customer Information</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted d-block">Name</small>
                    <strong class="fs-6">{{ $order->customer_name }}</strong>
                </div>

                <div class="mb-3">
                    <small class="text-muted d-block">Phone Number</small>
                    <a href="tel:{{ $order->phone }}" class="text-decoration-none fw-bold fs-6">
                        <i class="bi bi-telephone me-1"></i>{{ $order->phone }}
                    </a>
                </div>

                <div class="mb-0">
                    <small class="text-muted d-block">Delivery Address</small>
                    <p class="mb-0 fw-medium text-dark">{{ $order->address }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
