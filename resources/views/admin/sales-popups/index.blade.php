@extends('admin.layouts.app')

@section('title', 'Sales Popups')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0 fw-bold">Sales Popups</h5>
    <a href="{{ route('admin.sales-popups.create') }}" class="btn btn-primary px-4">
        <i class="bi bi-plus-lg me-1"></i> Create Popup
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Image</th>
                        <th>Customer Name</th>
                        <th>Time Ago</th>
                        <th>Product Info</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($popups as $popup)
                    <tr>
                        <td class="ps-4">
                            @if($popup->image)
                                <img src="{{ asset($popup->image) }}" alt="Popup Image" style="width: 40px; height: 40px; object-fit: cover; border-radius: 8px;">
                            @else
                                <div class="bg-light text-secondary d-flex align-items-center justify-content-center rounded" style="width: 40px; height: 40px;">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>{{ $popup->customer_name }}</td>
                        <td><span class="badge bg-secondary">{{ $popup->time_ago }}</span></td>
                        <td>{{ $popup->product_name }}</td>
                        <td>
                            @if($popup->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.sales-popups.edit', $popup->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.sales-popups.destroy', $popup->id) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-outline-danger delete-btn" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-bell-slash fs-1 d-block mb-3 opacity-50"></i>
                            No sales popups found. Click "Create Popup" to add one.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($popups->hasPages())
    <div class="card-footer bg-white border-0 py-3">
        {{ $popups->links() }}
    </div>
    @endif
</div>
@endsection
