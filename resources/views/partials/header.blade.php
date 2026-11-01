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
    </div>
    <div class="collapse" id="searchBar">
        <form action="{{ route('search') }}" method="get" class="container-xl pb-2">
            <div class="input-group">
                <input type="search" name="q" class="form-control" placeholder="পণ্য খুঁজুন..." value="{{ request('q') }}">
                <button class="btn btn-brand" type="submit"><i class="bi bi-search"></i></button>
            </div>
        </form>
    </div>
</header>

<div class="offcanvas offcanvas-start" tabindex="-1" id="menuCanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title brand-name">{{ $settings['site_name'] }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body menu-list">
        <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> হোম</a>
        <a href="{{ route('search') }}"><i class="bi bi-grid"></i> সব পণ্য</a>
        @if(\App\Models\Setting::whatsappNumber())
            <a href="https://wa.me/{{ \App\Models\Setting::whatsappNumber() }}" target="_blank" rel="noopener"><i class="bi bi-whatsapp"></i> WhatsApp</a>
        @endif
        @if(!empty($settings['phone']))
            <a href="tel:{{ preg_replace('/\s+/', '', $settings['phone']) }}"><i class="bi bi-telephone"></i> {{ $settings['phone'] }}</a>
        @endif
    </div>
</div>
