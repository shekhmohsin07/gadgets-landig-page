@extends('layouts.app')

@section('title', $settings['site_name'] . ' — Best Gadgets in Bangladesh')

@section('content')
<<<<<<< HEAD

{{-- Hero banners (95% width) --}}
@if($banners->count())
    <div class="hero-wrap">
=======
<div class="container-xl pt-3">
    {{-- Hero banners --}}
    @if($banners->count())
>>>>>>> affbddf8f8d532a5bdffe687b4b6384364a50c38
        <div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel">
            @if($banners->count() > 1)
                <div class="carousel-indicators">
                    @foreach($banners as $i => $b)
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $i }}" class="{{ $i === 0 ? 'active' : '' }}" aria-label="Slide {{ $i + 1 }}"></button>
                    @endforeach
                </div>
            @endif
            <div class="carousel-inner">
                @foreach($banners as $i => $b)
                    <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                        @if($b->link)<a href="{{ $b->link }}">@endif
                            <img src="{{ $b->image_url }}" class="d-block w-100" alt="{{ $b->title ?: $settings['site_name'] }}" {{ $i > 0 ? 'loading=lazy' : '' }}>
                        @if($b->link)</a>@endif
                    </div>
                @endforeach
            </div>
            @if($banners->count() > 1)
<<<<<<< HEAD
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" aria-label="Previous"><span class="carousel-control-prev-icon"></span></button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" aria-label="Next"><span class="carousel-control-next-icon"></span></button>
            @endif
        </div>
    </div>
@endif

<div class="container-xl">

    {{-- Trust strip --}}
    <div class="trust-strip">
        <div class="trust-item"><i class="bi bi-cash-coin"></i><div><b>ক্যাশ অন ডেলিভারি</b><span>পণ্য হাতে পেয়ে মূল্য দিন</span></div></div>
        <div class="trust-item"><i class="bi bi-truck"></i><div><b>সারা বাংলাদেশে ডেলিভারি</b><span>ঘরে বসেই অর্ডার করুন</span></div></div>
        <a href="{{ route('order.track.form') }}" class="trust-item text-reset"><i class="bi bi-box-seam"></i><div><b>অর্ডার ট্র্যাকিং</b><span>ফোন নাম্বার দিয়ে ট্র্যাক করুন</span></div></a>
        <div class="trust-item"><i class="bi bi-headset"></i><div><b>কাস্টমার সাপোর্ট</b><span>WhatsApp ও ফোনে সহায়তা</span></div></div>
    </div>
=======
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
            @endif
        </div>
    @endif
>>>>>>> affbddf8f8d532a5bdffe687b4b6384364a50c38

    {{-- Top selling --}}
    @if($topSelling->count())
        <h2 class="section-title text-center">Top Selling Products</h2>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-3">
            @foreach($topSelling as $p)
                @include('partials.product-card', ['p' => $p])
            @endforeach
        </div>
    @endif

    {{-- Popular --}}
    @if($popular->count())
        <h2 class="section-title">Popular Products</h2>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-3">
            @foreach($popular as $p)
                @include('partials.product-card', ['p' => $p])
            @endforeach
        </div>
    @endif

    @if($topSelling->isEmpty() && $popular->isEmpty())
        <p class="text-center text-muted py-5">No products yet. Add some from the admin panel.</p>
    @endif

    {{-- Testimonials --}}
    @if($testimonials->count())
        <h2 class="section-title text-center brand-text">আমাদের সম্মানিত ক্রেতাদের মতামত</h2>
        <div id="reviewCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($testimonials as $i => $t)
                    <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                        <div class="review-card">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="avatar">{{ mb_substr($t->name, 0, 1) }}</span>
                                <div>
                                    <div class="fw-semibold lh-sm">{{ $t->name }}</div>
                                    @if($t->handle)<div class="small text-muted lh-sm">{{ $t->handle }}</div>@endif
                                </div>
                            </div>
                            <p class="mb-1">{{ $t->message }}</p>
                            <div class="stars">{!! str_repeat('★', $t->rating) . str_repeat('☆', 5 - $t->rating) !!}</div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if($testimonials->count() > 1)
                <div class="carousel-indicators review-dots">
                    @foreach($testimonials as $i => $t)
                        <button type="button" data-bs-target="#reviewCarousel" data-bs-slide-to="{{ $i }}" class="{{ $i === 0 ? 'active' : '' }}"></button>
                    @endforeach
                </div>
            @endif
        </div>
    @endif
</div>
@endsection
