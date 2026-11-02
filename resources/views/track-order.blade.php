
@extends('layouts.app')

@section('title', $settings['site_name'] . ' — Order Tracking')

@section('content')

<div class="tracking-page">
    <div class="tracking-container">

<<<<<<< HEAD
        <i class="bi bi-truck track-icon"></i>
=======
>>>>>>> affbddf8f8d532a5bdffe687b4b6384364a50c38
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

<<<<<<< HEAD
=======
<style>
    .tracking-page {
        background: #f5f5f5;
        padding: 50px 15px;
    }

    .tracking-container {
        max-width: 650px;
        margin: auto;
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 5px 25px rgba(0,0,0,.06);
    }

    .tracking-container h1 {
        text-align: center;
        margin-bottom: 10px;
    }

    .subtitle {
        text-align: center;
        color: #777;
        margin-bottom: 30px;
    }

    .tracking-container label {
        display: block;
        margin: 15px 0 7px;
        font-weight: 600;
    }

    .tracking-container input {
        width: 100%;
        padding: 13px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 15px;
    }

    .tracking-container button {
        width: 100%;
        padding: 14px;
        margin-top: 20px;
        border: 0;
        border-radius: 6px;
        background: #F15A24;
        color: white;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
    }

    .tracking-container button:hover {
        background: #d94716;
    }

    .error {
        color: #dc2626;
        margin-top: 10px;
        font-size: 14px;
    }

    .result {
        margin-top: 35px;
        border-top: 1px solid #eee;
        padding-top: 25px;
    }

    .order-info {
        background: #fafafa;
        padding: 18px;
        border-radius: 8px;
        margin-bottom: 25px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }

    .info-row:last-child {
        border: 0;
    }

    .status {
        display: inline-block;
        padding: 7px 13px;
        background: #fff0e9;
        color: #F15A24;
        border-radius: 20px;
        font-weight: bold;
    }

    .timeline {
        margin-top: 25px;
    }

    .step {
        display: flex;
        gap: 15px;
        position: relative;
        min-height: 58px;
    }

    .step:not(:last-child)::before {
        content: "";
        position: absolute;
        left: 10px;
        top: 22px;
        height: 36px;
        width: 2px;
        background: #ddd;
    }

    .step.done:not(:last-child)::before {
        background: #F15A24;
    }

    .dot {
        width: 21px;
        height: 21px;
        border-radius: 50%;
        border: 2px solid #ccc;
        background: white;
        flex-shrink: 0;
        z-index: 1;
    }

    .step.done .dot {
        background: #F15A24;
        border-color: #F15A24;
    }

    .step p {
        margin: 2px 0 20px;
        color: #888;
    }

    .step.done p {
        color: #222;
        font-weight: bold;
    }

    .cancelled {
        padding: 15px;
        background: #fee2e2;
        color: #b91c1c;
        border-radius: 8px;
        font-weight: bold;
    }

    @media(max-width: 480px) {
        .tracking-container {
            padding: 22px 17px;
        }

        .info-row {
            font-size: 14px;
        }
    }
</style>

>>>>>>> affbddf8f8d532a5bdffe687b4b6384364a50c38
@endsection
