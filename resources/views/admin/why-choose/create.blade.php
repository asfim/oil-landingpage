@extends('admin.layouts.app')

@section('title', 'Add Why Choose Item')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Add Why Choose Us Item</h6>
        <a href="{{ route('admin.why-choose.index') }}" class="btn btn-sm btn-light border">Back</a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.why-choose.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" placeholder="e.g. মানের নিশ্চয়তা" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="0">
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea name="description" class="form-control" rows="3" placeholder="e.g. প্রতিটি প্রোডাক্ট কোয়ালিটি চেক করে পাঠানো হয়।" required></textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">SVG Icon Path Code (Optional)</label>
                    <input type="text" name="icon" class="form-control" placeholder='<path d="M12 2l8 4v6c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6l8-4z"/><path d="M9 12l2 2 4-4"/>'>
                    <small class="text-muted">Enter SVG inner path elements or leave empty for default shield icon.</small>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" id="isActive" name="is_active" checked>
                        <label class="form-check-label" for="isActive">Active (Show on landing page)</label>
                    </div>
                </div>
            </div>

            <hr>
            <button class="btn btn-primary">Save Item</button>
            <a href="{{ route('admin.why-choose.index') }}" class="btn btn-light border">Cancel</a>
        </form>
    </div>
</div>
@endsection
