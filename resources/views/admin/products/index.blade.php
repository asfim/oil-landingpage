@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Manage Products</h6>
        <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">Add New Product</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>
                            <img src="{{ asset($product->img) }}" alt="" style="width:40px;height:40px;object-fit:cover;border-radius:4px;">
                        </td>
                        <td>
                            <strong>{{ $product->name }}</strong><br>
                            <small class="text-muted">{{ Str::limit($product->tagline, 40) }}</small>
                        </td>
                        <td>
                            <span class="text-primary fw-bold">৳{{ $product->price }}</span>
                            @if($product->old_price)
                                <del class="text-muted ms-1" style="font-size:12px;">৳{{ $product->old_price }}</del>
                            @endif
                        </td>
                        <td>
                            @if($product->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-light border"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-light border text-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">No products found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
