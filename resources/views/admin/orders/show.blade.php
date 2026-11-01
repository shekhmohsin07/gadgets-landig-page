@extends('admin.layout')
@section('title', 'Order ' . $order->order_number)
@section('content')
<div class="d-flex align-items-center gap-2 mb-3">
    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left"></i></a>
    <h1 class="h4 fw-bold mb-0">Order {{ $order->order_number }}</h1>
    @include('admin.orders._status', ['status' => $order->status])
</div>

<div class="row g-3">
    <div class="col-lg-7">
        <div class="card mb-3"><div class="card-body">
            <h2 class="h6 fw-bold">Customer</h2>
            <div>{{ $order->customer_name }}</div>
            <div><a href="tel:{{ $order->phone }}">{{ $order->phone }}</a>
                · <a href="https://wa.me/88{{ $order->phone }}" target="_blank" rel="noopener">WhatsApp</a></div>
            <div class="text-muted mt-2">{{ $order->address }}</div>
            <div class="text-muted">{{ $order->thana }} {{ $order->district }}</div>
            <div class="small text-muted mt-2">Delivery area: {{ $order->delivery_zone === 'inside' ? 'Inside Dhaka' : 'Outside Dhaka' }} · Placed {{ $order->created_at->format('d M Y, h:i A') }} · IP {{ $order->ip_address }}</div>
        </div></div>

        <div class="card"><div class="card-body">
            <h2 class="h6 fw-bold">Items</h2>
            <div class="d-flex justify-content-between"><span>{{ $order->product_name }} × {{ $order->quantity }}</span><span>৳{{ number_format($order->unit_price * $order->quantity) }}</span></div>
            <div class="d-flex justify-content-between text-muted"><span>Delivery</span><span>৳{{ number_format($order->delivery_fee) }}</span></div>
            <hr>
            <div class="d-flex justify-content-between fw-bold"><span>Total (COD)</span><span>৳{{ number_format($order->total) }}</span></div>
        </div></div>
    </div>

    <div class="col-lg-5">
        <div class="card mb-3"><div class="card-body">
            <h2 class="h6 fw-bold">Update</h2>
            <form method="post" action="{{ route('admin.orders.update', $order) }}">
                @csrf @method('PATCH')
                <label class="form-label small">Status</label>
                <select name="status" class="form-select mb-3">
                    @foreach(\App\Models\Order::STATUSES as $k => $label)
                        <option value="{{ $k }}" @selected($order->status === $k)>{{ $label }}</option>
                    @endforeach
                </select>
                <label class="form-label small">Internal note</label>
                <textarea name="note" rows="3" class="form-control mb-3">{{ old('note', $order->note) }}</textarea>
                <button class="btn btn-brand w-100">Save</button>
            </form>
        </div></div>

        <form method="post" action="{{ route('admin.orders.destroy', $order) }}" onsubmit="return confirm('Delete this order permanently?')">
            @csrf @method('DELETE')
            <button class="btn btn-outline-danger btn-sm">Delete order</button>
        </form>
    </div>
</div>
@endsection
