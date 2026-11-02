
@extends('layouts.app')

@section('title', $settings['site_name'] . ' — Order Tracking')

@section('content')

<div class="tracking-page">
    <div class="tracking-container">

        <i class="bi bi-truck track-icon"></i>
        <h1>Track Your Order</h1>
        <p class="subtitle">
            Enter your order number and phone number to check your order status.
        </p>

        <form action="{{ route('order.track') }}" method="POST">
            @csrf

            <label>Order Number</label>
            <input
                type="text"
                name="order_number"
                value="{{ old('order_number') }}"
                placeholder="Enter your order number"
                required
            >

            <label>Phone Number</label>
            <input
                type="tel"
                name="phone"
                placeholder="01XXXXXXXXX"
                required
            >

            @error('tracking')
                <p class="error">{{ $message }}</p>
            @enderror

            @error('order_number')
                <p class="error">{{ $message }}</p>
            @enderror

            @error('phone')
                <p class="error">{{ $message }}</p>
            @enderror

            <button type="submit">Track Order</button>
        </form>

        @if($order)

            @php
                $statuses = [
                    'pending' => 'Order Placed',
                    'confirmed' => 'Order Confirmed',
                    'processing' => 'Processing',
                    'shipped' => 'Shipped',
                    'delivered' => 'Delivered',
                ];

                $currentIndex = array_search(
                    $order->status,
                    array_keys($statuses),
                    true
                );
            @endphp

            <div class="result">

                <h2>Order Details</h2>

                <div class="order-info">

                    <div class="info-row">
                        <strong>Order Number</strong>
                        <span>{{ $order->order_number }}</span>
                    </div>

                    <div class="info-row">
                        <strong>Product</strong>
                        <span>{{ $order->product_name }}</span>
                    </div>

                    <div class="info-row">
                        <strong>Quantity</strong>
                        <span>{{ $order->quantity }}</span>
                    </div>

                    <div class="info-row">
                        <strong>Total</strong>
                        <span>৳{{ number_format($order->total, 2) }}</span>
                    </div>

                    <div class="info-row">
                        <strong>Order Date</strong>
                        <span>
                            {{ $order->created_at->format('d M Y, h:i A') }}
                        </span>
                    </div>

                    <div class="info-row">
                        <strong>Current Status</strong>

                        <span class="status">
                            {{ \App\Models\Order::STATUSES[$order->status] ?? $order->status }}
                        </span>
                    </div>

                </div>

                <h3>Order Progress</h3>

                @if($order->status === 'cancelled')

                    <div class="cancelled">
                        This order has been cancelled.
                    </div>

                @elseif($currentIndex !== false)

                    <div class="timeline">

                        @foreach($statuses as $key => $label)

                            <div class="step {{ array_search($key, array_keys($statuses), true) <= $currentIndex ? 'done' : '' }}">

                                <div class="dot"></div>

                                <p>{{ $label }}</p>

                            </div>

                        @endforeach

                    </div>

                @else

                    <p>Current order status: {{ $order->status }}</p>

                @endif

            </div>

        @endif

    </div>
</div>

@endsection
