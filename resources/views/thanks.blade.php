@extends('layouts.app')

@section('title', 'অর্ডার সম্পন্ন | ' . $settings['site_name'])
@section('body_class', 'landing')

@section('content')
<div class="container-narrow py-4">
    <div class="thanks-card text-center">
        <div class="thanks-icon"><i class="bi bi-check-lg"></i></div>
        <h1 class="h4 fw-bold mt-3">ধন্যবাদ! আপনার অর্ডার সম্পন্ন হয়েছে</h1>
        <p class="text-muted mb-1">আমাদের প্রতিনিধি খুব শীঘ্রই ফোনে আপনার অর্ডার কনফার্ম করবেন।</p>
        <p class="mb-4">অর্ডার নাম্বার: <strong>{{ $order->order_number }}</strong></p>

        <div class="form-card text-start summary mb-3">
            <div class="d-flex justify-content-between"><span>পণ্য</span><span class="text-end ms-3">{{ $order->product_name }} × {{ $order->quantity }}</span></div>
            <div class="d-flex justify-content-between"><span>প্রোডাক্ট মূল্য</span><span>৳{{ number_format($order->unit_price * $order->quantity) }}</span></div>
            <div class="d-flex justify-content-between"><span>ডেলিভারি চার্জ</span><span>৳{{ number_format($order->delivery_fee) }}</span></div>
            <hr>
            <div class="d-flex justify-content-between fw-bold"><span>মোট (ক্যাশ অন ডেলিভারি)</span><span class="brand-text">৳{{ number_format($order->total) }}</span></div>
            <hr>
            <div class="small"><strong>{{ $order->customer_name }}</strong> · {{ $order->phone }}</div>
            <div class="small text-muted">{{ $order->address }}@if($order->thana), {{ $order->thana }}@endif @if($order->district), {{ $order->district }}@endif</div>
        </div>

        <a href="{{ route('home') }}" class="btn btn-brand btn-lg w-100">আরও পণ্য দেখুন</a>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Pixel: Purchase — fires once per order, even if the page is refreshed.
(function () {
    var key = 'gc_purchase_{{ $order->order_number }}';
    try { if (sessionStorage.getItem(key)) return; sessionStorage.setItem(key, '1'); } catch (e) {}
    window.gcTrack && gcTrack('Purchase', {
        ids: [@json((string) $order->product_id)],
        name: @json($order->product_name),
        value: {{ (int) $order->total }},
        price: {{ (int) $order->unit_price }},
        qty: {{ (int) $order->quantity }},
        orderId: @json($order->order_number)
    });
})();
</script>
@endpush
