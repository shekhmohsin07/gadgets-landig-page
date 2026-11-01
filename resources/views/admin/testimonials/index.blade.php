@extends('admin.layout')
@section('title', 'Customer reviews')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div><h1 class="h4 fw-bold mb-0">Customer reviews</h1><div class="text-muted small">Shown in the slider at the bottom of the home page. Add only real reviews.</div></div>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-brand"><i class="bi bi-plus-lg"></i> New review</a>
</div>
<div class="card"><div class="table-responsive">
    <table class="table align-middle mb-0">
        <thead class="table-light"><tr><th>Name</th><th>Message</th><th>Rating</th><th>Status</th><th></th></tr></thead>
        <tbody>
        @forelse($items as $t)
            <tr>
                <td>{{ $t->name }}<div class="small text-muted">{{ $t->handle }}</div></td>
                <td class="small" style="max-width:420px">{{ \Illuminate\Support\Str::limit($t->message, 120) }}</td>
                <td>{{ $t->rating }}★</td>
                <td>{!! $t->is_active ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-secondary">Hidden</span>' !!}</td>
                <td class="text-end text-nowrap">
                    <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                    <form class="d-inline" method="post" action="{{ route('admin.testimonials.destroy', $t) }}" onsubmit="return confirm('Delete review?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center text-muted py-4">No reviews yet.</td></tr>
        @endforelse
        </tbody>
    </table>
</div></div>
@endsection
