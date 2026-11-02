@extends('admin.layout')
@section('title', 'Dashboard')
@section('content')
<h1 class="h4 fw-bold mb-3">Dashboard</h1>

<div class="row g-3 mb-4">
    @foreach([
        ['Orders today', $stats['today'], 'bi-calendar-check'],
        ['Pending orders', $stats['pending'], 'bi-hourglass-split'],
        ['Total orders', $stats['orders'], 'bi-receipt'],
        ['Revenue (excl. cancelled)', '৳' . number_format($stats['revenue']), 'bi-cash-coin'],
    ] as [$label, $value, $icon])
        <div class="col-6 col-xl-3">
            <div class="card h-100"><div class="card-body">
                <div class="text-muted small"><i class="bi {{ $icon }} me-1"></i>{{ $label }}</div>
                <div class="stat">{{ $value }}</div>
            </div></div>
        </div>
    @endforeach
</div>

<div class="card">
    <div class="card-header bg-white fw-semibold d-flex justify-content-between">
        Recent orders <a href="{{ route('admin.orders.index') }}" class="small">View all</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light"><tr><th>Order</th><th>Customer</th><th>Product</th><th class="text-end">Total</th><th>Status</th><th>Time</th></tr></thead>
            <tbody>
            @forelse($recent as $o)
                <tr>
                    <td><a href="{{ route('admin.orders.show', $o) }}">{{ $o->order_number }}</a></td>
                    <td>{{ $o->customer_name }}<div class="small text-muted">{{ $o->phone }}</div></td>
                    <td class="small">{{ \Illuminate\Support\Str::limit($o->product_name, 40) }} × {{ $o->quantity }}</td>
                    <td class="text-end">৳{{ number_format($o->total) }}</td>
                    <td>@include('admin.orders._status', ['status' => $o->status])</td>
                    <td class="small text-muted">{{ $o->created_at->diffForHumans() }}</td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-4">No orders yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
