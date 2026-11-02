@extends('layouts.app')

@section('title', $product->name . ' | ' . $settings['site_name'])
@section('description', \Illuminate\Support\Str::limit(strip_tags($product->description ?: $product->name), 150))
@section('body_class', 'landing')

@push('meta')
    <meta property="og:type" content="product">
    <meta property="og:title" content="{{ $product->name }}">
    <meta property="og:image" content="{{ $product->image_url }}">
    <meta property="product:price:amount" content="{{ $product->price }}">
    <meta property="product:price:currency" content="BDT">
@endpush

@section('custom_header')
    <header class="site-header sticky-top landing-header">
        <div class="container-narrow d-flex align-items-center gap-2 py-2">
            <a href="{{ route('home') }}" class="icon-btn" aria-label="Back"><i class="bi bi-chevron-left"></i></a>
            <div class="landing-title text-truncate">{{ $product->name }}</div>
            @if($waLink)
                <a href="{{ $waLink }}" target="_blank" rel="noopener" class="icon-btn wa-btn ms-auto" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
            @endif
        </div>
    </header>
@endsection

@section('content')
<div class="container-narrow">

    {{-- Gallery --}}
    @php $images = $product->gallery_urls; @endphp
    <section class="gallery">
        @if($product->badge)<span class="p-badge">{{ $product->badge }}</span>@endif
        <div id="gallery" class="carousel slide" data-bs-interval="false">
            <div class="carousel-inner">
                @foreach($images as $i => $url)
                    <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                        <img src="{{ $url }}" class="d-block w-100 gallery-img" alt="{{ $product->name }}" {{ $i > 0 ? 'loading=lazy' : '' }}>
                    </div>
                @endforeach
            </div>
            @if(count($images) > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#gallery" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                <button class="carousel-control-next" type="button" data-bs-target="#gallery" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
            @endif
        </div>
        @if(count($images) > 1)
            <div class="thumbs">
                @foreach($images as $i => $url)
                    <button type="button" data-bs-target="#gallery" data-bs-slide-to="{{ $i }}" class="{{ $i === 0 ? 'active' : '' }}" aria-label="Image {{ $i + 1 }}">
                        <img src="{{ $url }}" alt="" loading="lazy">
                    </button>
                @endforeach
            </div>
        @endif
    </section>

    {{-- Title / price --}}
    <section class="info-block">
        <h1 class="product-name">{{ $product->name }}</h1>
        <div class="price-row">
            <span class="price-now">৳{{ number_format($product->price) }}</span>
            @if($product->old_price)<del class="price-old">৳{{ number_format($product->old_price) }}</del>@endif
            @if($product->discount_percent > 0)<span class="save-pill">Save {{ $product->discount_percent }}%</span>@endif
        </div>
        @if($product->reviews_count > 0)
            <div class="rating-row"><span class="stars">★★★★★</span> {{ number_format($product->rating, 1) }} ({{ $product->reviews_count }} reviews)</div>
        @endif

        <div class="cta-stack">
            <a href="#order-form" class="btn btn-brand btn-lg w-100 js-order-now"><i class="bi bi-cart3"></i> ORDER NOW</a>
            @if($waLink)
                <a href="{{ $waLink }}" target="_blank" rel="noopener" class="btn btn-wa btn-lg w-100"><i class="bi bi-whatsapp"></i> Order On WhatsApp</a>
            @endif
            @if(!empty($settings['phone']))
                <a href="tel:{{ preg_replace('/\s+/', '', $settings['phone']) }}" class="btn btn-brand-dark btn-lg w-100"><i class="bi bi-telephone"></i> {{ $settings['phone'] }}</a>
            @endif
        </div>
    </section>

    {{-- Description --}}
    @if($product->description)
        <section class="desc-block">
            <h2 class="block-title">বিস্তারিত</h2>
            <div class="desc-text">{!! nl2br(e($product->description)) !!}</div>
        </section>
    @endif

    {{-- Customer review screenshots --}}
    @if(count($product->review_image_urls))
        <section class="proof-block">
            <h2 class="block-title">কাস্টমারদের মতামত</h2>
            <div class="proof-strip">
                @foreach($product->review_image_urls as $url)
                    <img src="{{ $url }}" alt="Customer review" loading="lazy">
                @endforeach
            </div>
        </section>
    @endif

    {{-- Order form --}}
    <section id="order-form" class="order-block">
        <h2 class="block-title center">📝 অর্ডার ফর্ম পূরণ করুন</h2>

        @if($errors->any())
            <div class="alert alert-danger py-2 small">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('order.store') }}" method="post" id="orderForm" novalidate>
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            {{-- honeypot --}}
            <div class="d-none" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>

            <div class="form-card">
                <div class="mb-3">
                    <label class="form-label" for="customer_name">আপনার নাম <span class="req">*</span></label>
                    <input type="text" id="customer_name" name="customer_name" class="form-control @error('customer_name') is-invalid @enderror" value="{{ old('customer_name') }}" placeholder="আপনার নাম লিখুন" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="phone">মোবাইল নাম্বার <span class="req">*</span></label>
                    <input type="tel" id="phone" name="phone" inputmode="numeric" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="আপনার মোবাইল নাম্বার লিখুন" required>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <label class="form-label" for="district">জেলা</label>
                        <input type="text" id="district" name="district" class="form-control" value="{{ old('district') }}" placeholder="আপনার জেলা">
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="thana">থানা</label>
                        <input type="text" id="thana" name="thana" class="form-control" value="{{ old('thana') }}" placeholder="আপনার থানা">
                    </div>
                </div>
                <div>
                    <label class="form-label" for="address">ডেলিভারি ঠিকানা <span class="req">*</span></label>
                    <textarea id="address" name="address" rows="2" class="form-control @error('address') is-invalid @enderror" placeholder="গ্রাম/মহল্লা, রোড নং" required>{{ old('address') }}</textarea>
                </div>
            </div>

            <div class="form-card">
                <div class="form-label mb-2">পেমেন্ট মেথড</div>
                <label class="choice active"><input type="radio" checked disabled> <span>ক্যাশ অন ডেলিভারি</span></label>
            </div>

            <div class="form-card">
                <div class="form-label mb-2">ডেলিভারি এরিয়া সিলেক্ট করুন</div>
                <label class="choice">
                    <input type="radio" name="delivery_zone" value="inside" data-fee="{{ $fees['inside'] }}" {{ old('delivery_zone', 'inside') === 'inside' ? 'checked' : '' }}>
                    <span>ঢাকার ভিতরে <small>(৳{{ number_format($fees['inside']) }} টাকা)</small></span>
                </label>
                <label class="choice">
                    <input type="radio" name="delivery_zone" value="outside" data-fee="{{ $fees['outside'] }}" {{ old('delivery_zone') === 'outside' ? 'checked' : '' }}>
                    <span>ঢাকার বাইরে <small>(৳{{ number_format($fees['outside']) }} টাকা)</small></span>
                </label>
            </div>

            <div class="form-card d-flex align-items-center justify-content-between">
                <span class="fw-semibold">Quantity:</span>
                <div class="qty">
                    <button type="button" id="qtyMinus" aria-label="Decrease">−</button>
                    <input type="text" id="qty" name="quantity" value="{{ old('quantity', 1) }}" readonly>
                    <button type="button" id="qtyPlus" aria-label="Increase">+</button>
                </div>
            </div>

            <div class="form-card summary">
                <div class="d-flex justify-content-between"><span>প্রোডাক্ট মূল্য</span><span id="sumPrice">৳0</span></div>
                <div class="d-flex justify-content-between"><span>ডেলিভারি চার্জ</span><span id="sumFee">৳0</span></div>
                <hr>
                <div class="d-flex justify-content-between fw-bold fs-5"><span>মোট মূল্য:</span><span class="brand-text" id="sumTotal">৳0</span></div>
            </div>

            <button type="submit" class="btn btn-brand btn-lg w-100 fw-bold" id="submitBtn">অর্ডার সম্পন্ন করুন</button>
        </form>
    </section>
</div>

{{-- More products --}}
<div class="container-xl">
    @if($related->count())
        <h2 class="section-title">আরও পণ্য</h2>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-3">
            @foreach($related as $p)
                @include('partials.product-card', ['p' => $p])
            @endforeach
        </div>
    @endif

    @if($topSelling->count())
        <h2 class="section-title">🔥 Top Selling Products</h2>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-3 mb-4">
            @foreach($topSelling as $p)
                @include('partials.product-card', ['p' => $p])
            @endforeach
        </div>
    @endif
</div>
@endsection

@push('scripts')
@php $jsProduct = ['id' => $product->id, 'name' => $product->name, 'price' => $product->price]; @endphp
<script>
window.GC_PRODUCT = @json($jsProduct);
// Pixel: ViewContent
window.gcTrack && gcTrack('ViewContent', { ids: [String(GC_PRODUCT.id)], name: GC_PRODUCT.name, value: GC_PRODUCT.price, price: GC_PRODUCT.price, qty: 1 });
</script>
@endpush
