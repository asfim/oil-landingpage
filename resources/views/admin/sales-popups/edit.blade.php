@extends('admin.layouts.app')

@section('title', 'Edit Sales Popup')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0 fw-bold">Edit Sales Popup</h5>
    <a href="{{ route('admin.sales-popups.index') }}" class="btn btn-outline-secondary px-4">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('admin.sales-popups.update', $salesPopup->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Customer Name <span class="text-danger">*</span></label>
                    <input type="text" name="customer_name" class="form-control @error('customer_name') is-invalid @enderror" value="{{ old('customer_name', $salesPopup->customer_name) }}" required>
                    @error('customer_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Time Ago <span class="text-danger">*</span></label>
                    <input type="text" name="time_ago" class="form-control @error('time_ago') is-invalid @enderror" value="{{ old('time_ago', $salesPopup->time_ago) }}" required>
                    @error('time_ago') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="col-md-8 mb-3">
                    <label class="form-label fw-semibold">Product Name <span class="text-danger">*</span></label>
                    <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror" value="{{ old('product_name', $salesPopup->product_name) }}" required>
                    @error('product_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" {{ old('is_active', $salesPopup->is_active) ? 'checked' : '' }} style="transform: scale(1.3); margin-left: -2em;">
                        <label class="form-check-label ms-2" for="isActive">Active (Show on website)</label>
                    </div>
                </div>

                <div class="col-md-12 mb-4">
                    <label class="form-label fw-semibold">Product Image (Optional)</label>
                    @if($salesPopup->image)
                        <div class="mb-2">
                            <img src="{{ asset($salesPopup->image) }}" alt="Current Image" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd;">
                            <small class="text-muted ms-2">Current Image</small>
                        </div>
                    @endif
                    <input type="file" name="image_file" class="form-control @error('image_file') is-invalid @enderror" accept="image/*">
                    <small class="text-muted d-block mt-1">Upload a new image to replace the current one.</small>
                    @error('image_file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <hr class="mb-4">
            
            <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-save me-1"></i> Update Popup
            </button>
        </form>
    </div>
</div>
@endsection
