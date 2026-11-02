<<<<<<< HEAD
@php
    $waNum = \App\Models\Setting::whatsappNumber();
    $logo  = \App\Models\Setting::logoUrl();
@endphp
<header class="site-header sticky-top">
    <div class="container-xl header-bar">
        <div class="hb-left">
            <button class="icon-btn d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuCanvas" aria-label="Menu">
                <i class="bi bi-list"></i>
            </button>
            <nav class="top-nav d-none d-lg-flex" aria-label="Main">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">হোম</a>
                <a href="{{ route('search') }}" class="{{ request()->routeIs('search') ? 'active' : '' }}">সব পণ্য</a>
                <a href="{{ route('order.track.form') }}" class="{{ request()->routeIs('order.track*') ? 'active' : '' }}">অর্ডার ট্র্যাক</a>
            </nav>
        </div>

        <a href="{{ route('home') }}" class="brand-name" aria-label="{{ $settings['site_name'] }}">
            <img src="{{ $logo }}" alt="" class="brand-logo">
            <span>{{ $settings['site_name'] }}</span>
        </a>

        <div class="hb-right">
            <a href="{{ route('order.track.form') }}" class="icon-btn {{ request()->routeIs('order.track*') ? 'is-active' : '' }}" aria-label="অর্ডার ট্র্যাক" title="অর্ডার ট্র্যাক">
                <i class="bi bi-truck"></i>
            </a>
            <button class="icon-btn" type="button" data-bs-toggle="collapse" data-bs-target="#searchBar" aria-label="Search" title="Search">
                <i class="bi bi-search"></i>
            </button>
        </div>
=======
<header class="site-header sticky-top">
    <div class="container-xl d-flex align-items-center justify-content-between py-2">
        <button class="icon-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuCanvas" aria-label="Menu">
            <i class="bi bi-list"></i>
        </button>

        <a href="{{ route('home') }}" class="brand-name">
            @if(!empty($settings['site_logo']))
                <img src="{{ asset($settings['site_logo']) }}" alt="{{ $settings['site_name'] }}" class="brand-logo">
            @else
                {{ $settings['site_name'] }}
            @endif
        </a>

        <button class="icon-btn" type="button" data-bs-toggle="collapse" data-bs-target="#searchBar" aria-label="Search">
            <i class="bi bi-search"></i>
        </button>
>>>>>>> affbddf8f8d532a5bdffe687b4b6384364a50c38
    </div>
    <div class="collapse" id="searchBar">
        <form action="{{ route('search') }}" method="get" class="container-xl pb-2">
            <div class="input-group">
                <input type="search" name="q" class="form-control" placeholder="পণ্য খুঁজুন..." value="{{ request('q') }}">
<<<<<<< HEAD
                <button class="btn btn-brand" type="submit" aria-label="Search"><i class="bi bi-search"></i></button>
=======
                <button class="btn btn-brand" type="submit"><i class="bi bi-search"></i></button>
>>>>>>> affbddf8f8d532a5bdffe687b4b6384364a50c38
            </div>
        </form>
    </div>
</header>

<div class="offcanvas offcanvas-start" tabindex="-1" id="menuCanvas">
    <div class="offcanvas-header">
<<<<<<< HEAD
        <h5 class="offcanvas-title brand-name"><img src="{{ $logo }}" alt="" class="brand-logo"><span>{{ $settings['site_name'] }}</span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body menu-list">
        <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> হোম <i class="bi bi-chevron-right chev"></i></a>
        <a href="{{ route('search') }}"><i class="bi bi-grid"></i> সব পণ্য <i class="bi bi-chevron-right chev"></i></a>
        <a href="{{ route('order.track.form') }}"><i class="bi bi-truck"></i> অর্ডার ট্র্যাক <i class="bi bi-chevron-right chev"></i></a>
        @if($waNum)
            <a href="https://wa.me/{{ $waNum }}" target="_blank" rel="noopener"><i class="bi bi-whatsapp"></i> WhatsApp <i class="bi bi-chevron-right chev"></i></a>
        @endif
        @if(!empty($settings['phone']))
            <a href="tel:{{ preg_replace('/\s+/', '', $settings['phone']) }}"><i class="bi bi-telephone"></i> {{ $settings['phone'] }} <i class="bi bi-chevron-right chev"></i></a>
=======
        <h5 class="offcanvas-title brand-name">{{ $settings['site_name'] }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body menu-list">
        <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> হোম</a>
        <a href="{{ route('search') }}"><i class="bi bi-grid"></i> সব পণ্য</a>
        <a href="{{ route('order.track.form') }}"><i class="bi bi-grid">অর্ডার ট্র্যাক</i></a>
        @if(\App\Models\Setting::whatsappNumber())
            <a href="https://wa.me/{{ \App\Models\Setting::whatsappNumber() }}" target="_blank" rel="noopener"><i class="bi bi-whatsapp"></i> WhatsApp</a>
        @endif
        @if(!empty($settings['phone']))
            <a href="tel:{{ preg_replace('/\s+/', '', $settings['phone']) }}"><i class="bi bi-telephone"></i> {{ $settings['phone'] }}</a>
>>>>>>> affbddf8f8d532a5bdffe687b4b6384364a50c38
        @endif
    </div>
</div>
