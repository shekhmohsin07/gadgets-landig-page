@extends('admin.layout')
@php $isEdit = $item->exists; @endphp
@section('title', $isEdit ? 'Edit review' : 'New review')
@section('content')
<h1 class="h4 fw-bold mb-3">{{ $isEdit ? 'Edit review' : 'New review' }}</h1>
<form method="post" class="card card-body" style="max-width:640px"
      action="{{ $isEdit ? route('admin.testimonials.update', $item) : route('admin.testimonials.store') }}">
    @csrf @if($isEdit) @method('PUT') @endif
    <div class="row g-3 mb-3">
        <div class="col-md-6"><label class="form-label">Customer name *</label><input name="name" class="form-control" value="{{ old('name', $item->name) }}" required></div>
        <div class="col-md-6"><label class="form-label">Handle (optional)</label><input name="handle" class="form-control" placeholder="@name" value="{{ old('handle', $item->handle) }}"></div>
    </div>
    <div class="mb-3"><label class="form-label">Review *</label><textarea name="message" rows="4" class="form-control" required>{{ old('message', $item->message) }}</textarea></div>
    <div class="row g-3 mb-3">
        <div class="col-6"><label class="form-label">Rating</label>
            <select name="rating" class="form-select">@for($i = 5; $i >= 1; $i--)<option value="{{ $i }}" @selected(old('rating', $item->rating) == $i)>{{ $i }} ★</option>@endfor</select></div>
        <div class="col-6"><label class="form-label">Sort order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $item->sort_order ?? 0) }}"></div>
    </div>
    <div class="form-check form-switch mb-3"><input class="form-check-input" type="checkbox" name="is_active" value="1" id="a" @checked(old('is_active', $item->is_active ?? true))><label class="form-check-label" for="a">Active</label></div>
    <div class="d-flex gap-2"><button class="btn btn-brand">Save</button><a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">Cancel</a></div>
</form>
@endsection
