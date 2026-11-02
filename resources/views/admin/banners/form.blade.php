@extends('admin.layout')
@php $isEdit = $banner->exists; @endphp
@section('title', $isEdit ? 'Edit banner' : 'New banner')
@section('content')
<h1 class="h4 fw-bold mb-3">{{ $isEdit ? 'Edit banner' : 'New banner' }}</h1>
<form method="post" enctype="multipart/form-data" class="card card-body" style="max-width:640px"
      action="{{ $isEdit ? route('admin.banners.update', $banner) : route('admin.banners.store') }}">
    @csrf @if($isEdit) @method('PUT') @endif
    <div class="mb-3">
        <label class="form-label">Banner image {{ $isEdit ? '' : '*' }}</label>
        @if($isEdit)<div class="mb-2"><img src="{{ $banner->image_url }}" style="max-width:100%;border-radius:8px" alt=""></div>@endif
        <input type="file" name="image" accept="image/*" class="form-control" {{ $isEdit ? '' : 'required' }}>
        <div class="form-text">Recommended size 1600 × 640 px (wide).</div>
    </div>
    <div class="mb-3"><label class="form-label">Title (alt text)</label><input name="title" class="form-control" value="{{ old('title', $banner->title) }}"></div>
    <div class="mb-3"><label class="form-label">Link (optional)</label><input name="link" class="form-control" placeholder="/product/scalp-massager" value="{{ old('link', $banner->link) }}"></div>
    <div class="mb-3"><label class="form-label">Sort order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $banner->sort_order ?? 0) }}"></div>
    <div class="form-check form-switch mb-3"><input class="form-check-input" type="checkbox" name="is_active" value="1" id="a" @checked(old('is_active', $banner->is_active ?? true))><label class="form-check-label" for="a">Active</label></div>
    <div class="d-flex gap-2"><button class="btn btn-brand">Save</button><a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary">Cancel</a></div>
</form>
@endsection
