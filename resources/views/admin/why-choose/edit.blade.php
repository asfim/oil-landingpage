@extends('admin.layouts.app')

@section('title', 'Edit Why Choose Item')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Edit Item: {{ $item->title }}</h6>
        <a href="{{ route('admin.why-choose.index') }}" class="btn btn-sm btn-light border">Back</a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.why-choose.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ $item->title }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ $item->sort_order }}">
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea name="description" class="form-control" rows="3" required>{{ $item->description }}</textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Icon Class (e.g. bi-star, bi-heart)</label>
                    <input type="text" name="icon" class="form-control" value="{{ $item->icon }}">
                    <small class="text-muted">Enter a Bootstrap Icon class name or leave empty for default shield icon.</small>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" id="isActive" name="is_active" {{ $item->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="isActive">Active (Show on landing page)</label>
                    </div>
                </div>
            </div>

            <hr>
            <button class="btn btn-primary">Update Item</button>
            <a href="{{ route('admin.why-choose.index') }}" class="btn btn-light border">Cancel</a>
        </form>
    </div>
</div>
@endsection
