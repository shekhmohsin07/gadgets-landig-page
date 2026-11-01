@extends('admin.layout')
@section('title', 'Orders')
@section('content')
<h1 class="h4 fw-bold mb-3">Orders</h1>

<div class="d-flex flex-wrap gap-2 mb-3">
    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm {{ $status ? 'btn-outline-secondary' : 'btn-brand' }}">All</a>
    @foreach(\App\Models\Order::STATUSES as $key => $label)
        <a href="{{ route('admin.orders.index', ['status' => $key]) }}" class="btn btn-sm {{ $status === $key ? 'btn-brand' : 'btn-outline-secondary' }}">
            {{ $label }} <span class="badge text-bg-light">{{ $counts[$key] ?? 0 }}</span>
        </a>
    @endforeach
    <form class="ms-auto d-flex gap-2" method="get">
        @if($status)<input type="hidden" name="status" value="{{ $status }}">@endif
        <input type="search" name="q" value="{{ $q }}" class="form-control form-control-sm" placeholder="Order no, phone, name">
        <button class="btn btn-sm btn-brand">Search</button>
    </form>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light"><tr><th>Order</th><th>Customer</th><th>Product</th><th class="text-end">Total</th><th>Status</th><th>Placed</th><th></th></tr></thead>
            <tbody>
            @forelse($orders as $o)
                <tr>
                    <td><a href="{{ route('admin.orders.show', $o) }}" class="fw-semibold">{{ $o->order_number }}</a></td>
                    <td>{{ $o->customer_name }}<div class="small text-muted">{{ $o->phone }}</div></td>
                    <td class="small">{{ \Illuminate\Support\Str::limit($o->product_name, 45) }} × {{ $o->quantity }}</td>
                    <td class="text-end">৳{{ number_format($o->total) }}</td>
                    <td>@include('admin.orders._status', ['status' => $o->status])</td>
                    <td class="small text-muted">{{ $o->created_at->format('d M, h:i A') }}</td>
                    <td class="text-end"><a href="{{ route('admin.orders.show', $o) }}" class="btn btn-sm btn-outline-primary">View</a></td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-muted py-4">No orders found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $orders->links() }}</div>
@endsection
