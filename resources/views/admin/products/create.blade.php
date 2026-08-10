@extends('admin.layouts.app')

@section('title', 'Add Product')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <h6 class="mb-0 fw-bold">Add New Product</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Price (৳)</label>
                    <input type="number" step="0.01" name="price" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Old Price (৳)</label>
                    <input type="number" step="0.01" name="old_price" class="form-control">
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="desc" class="form-control" rows="3" required></textarea>
                </div>
                
                <div class="col-md-3 mb-3">
                    <label class="form-label">Rating (0-5)</label>
                    <input type="number" step="0.1" name="rating" class="form-control" value="5.0" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Reviews Count</label>
                    <input type="number" name="reviews" class="form-control" value="0" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Badge (e.g. Best Seller)</label>
                    <input type="text" name="badge" class="form-control">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="0">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Product Image</label>
                    <input type="file" name="img_file" class="form-control" accept="image/*">
                </div>
                
                <div class="col-md-12 mb-3">
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" id="isActive" name="is_active" checked>
                        <label class="form-check-label" for="isActive">Active (Show on website)</label>
                    </div>
                </div>
            </div>
            
            <hr>
            <button class="btn btn-primary">Save Product</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-light border">Cancel</a>
        </form>
    </div>
</div>
@endsection
