@extends('admin.layout')
@section('title', 'Products')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h1 class="h4 fw-bold mb-0">Products / Landing pages</h1>
        <div class="text-muted small">Every product automatically gets its own landing page at <code>/product/&lt;slug&gt;</code>. "Buy Now" on the home page links there.</div>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn btn-brand"><i class="bi bi-plus-lg"></i> New product</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light"><tr><th></th><th>Name</th><th>Price</th><th>Home sections</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
            <tbody>
            @forelse($products as $p)
                <tr>
                    <td><img src="{{ $p->image_url }}" class="thumb" alt=""></td>
                    <td style="max-width:320px"><div class="fw-semibold">{{ \Illuminate\Support\Str::limit($p->name, 70) }}</div>
                        <a class="small" href="{{ route('product.show', $p) }}" target="_blank">/product/{{ $p->slug }}</a></td>
                    <td>৳{{ number_format($p->price) }} @if($p->old_price)<del class="text-muted small">৳{{ number_format($p->old_price) }}</del>@endif</td>
                    <td>
                        @if($p->is_top_selling)<span class="badge text-bg-danger">Top selling</span>@endif
                        @if($p->is_popular)<span class="badge text-bg-primary">Popular</span>@endif
                    </td>
                    <td>{!! $p->is_active ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-secondary">Hidden</span>' !!}</td>
                    <td class="text-end text-nowrap">
                        <a href="{{ route('admin.products.edit', $p) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form class="d-inline" method="post" action="{{ route('admin.products.destroy', $p) }}" onsubmit="return confirm('Delete this product and its images?')">
                            @csrf @method('DELETE') <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-4">No products yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $products->links() }}</div>
@endsection
