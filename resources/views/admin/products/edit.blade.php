@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Edit Product: {{ $product->name }}</h6>
        <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-light border">Back</a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tagline / Subtitle</label>
                    <input type="text" name="tagline" class="form-control" value="{{ $product->tagline }}" placeholder="e.g. ১০০% প্রাকৃতিক ভেষজ নির্যাস...">
                </div>
                
                <div class="col-md-3 mb-3">
                    <label class="form-label">Price (৳)</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Old Price (৳)</label>
                    <input type="number" step="0.01" name="old_price" class="form-control" value="{{ $product->old_price }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Badge (e.g. ফ্রি হোম ডেলিভারি)</label>
                    <input type="text" name="badge" class="form-control" value="{{ $product->badge }}">
                </div>
                

                
                <div class="col-md-3 mb-3">
                    <label class="form-label">Rating (0-5)</label>
                    <input type="number" step="0.1" name="rating" class="form-control" value="{{ $product->rating }}" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Reviews Count</label>
                    <input type="number" name="reviews" class="form-control" value="{{ $product->reviews }}" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ $product->sort_order }}">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Product Image (Leave empty to keep current)</label>
                    <input type="file" name="img_file" class="form-control" accept="image/*">
                    <div class="mt-2">
                        <img src="{{ asset($product->img) }}" alt="Current Image" style="height:60px; border-radius:4px; border:1px solid #ddd; padding:2px;">
                    </div>
                </div>
                
                <div class="col-md-12 mb-3">
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" id="isActive" name="is_active" {{ $product->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="isActive">Active (Show on website)</label>
                    </div>
                </div>
            </div>
            
            <hr>
            <button class="btn btn-primary">Update Product</button>
        </form>
    </div>
</div>
@endsection
