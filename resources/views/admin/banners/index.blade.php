@extends('admin.layout')
@section('title', 'Banners')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 fw-bold mb-0">Home banners</h1>
    <a href="{{ route('admin.banners.create') }}" class="btn btn-brand"><i class="bi bi-plus-lg"></i> New banner</a>
</div>
<div class="row g-3">
    @forelse($banners as $b)
        <div class="col-md-6 col-xl-4">
            <div class="card h-100">
                <img src="{{ $b->image_url }}" class="card-img-top" alt="" style="aspect-ratio:16/6.4;object-fit:cover">
                <div class="card-body">
                    <div class="fw-semibold">{{ $b->title ?: 'Untitled' }}</div>
                    <div class="small text-muted text-truncate">{{ $b->link ?: 'No link' }}</div>
                    <div class="mt-2">{!! $b->is_active ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-secondary">Hidden</span>' !!} <span class="small text-muted">order {{ $b->sort_order }}</span></div>
                </div>
                <div class="card-footer bg-white d-flex gap-2">
                    <a href="{{ route('admin.banners.edit', $b) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                    <form method="post" action="{{ route('admin.banners.destroy', $b) }}" onsubmit="return confirm('Delete banner?')">@csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Delete</button></form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-muted">No banners yet.</div>
    @endforelse
</div>
@endsection
