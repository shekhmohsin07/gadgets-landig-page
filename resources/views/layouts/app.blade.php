<!doctype html>
<html lang="bn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', $settings['site_name'])</title>
    <meta name="description" content="@yield('description', $settings['meta_description'])">
    @stack('meta')
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
    <meta name="theme-color" content="{{ $settings['accent_color'] ?: '#0a0a0a' }}">
    <meta property="og:site_name" content="{{ $settings['site_name'] }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}?v=3" rel="stylesheet">
    <style>
        :root {
            --brand: {{ $settings['primary_color'] ?: '#e30000' }};
            --dark: {{ $settings['accent_color'] ?: '#0a0a0a' }};
        }
    </style>

    @include('partials.pixels-head')
</head>
<body class="@yield('body_class')">
    @include('partials.pixels-body')

    @hasSection('custom_header')
        @yield('custom_header')
    @else
        @include('partials.header')
    @endif

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @php $wa = \App\Models\Setting::whatsappNumber(); @endphp
    @if($wa)
        <a href="{{ $waLink ?? 'https://wa.me/' . $wa }}" class="wa-float" target="_blank" rel="noopener" aria-label="WhatsApp">
            <i class="bi bi-whatsapp"></i>
        </a>
    @endif

    <nav class="bottom-nav d-lg-none">
        @if($wa)
            <a href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener"><i class="bi bi-chat-dots"></i><span>WhatsApp</span></a>
        @endif
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}"><i class="bi bi-house-door"></i><span>Home</span></a>
        <a href="{{ route('search') }}" class="{{ request()->routeIs('search') ? 'active' : '' }}"><i class="bi bi-search"></i><span>Search</span></a>
        <a href="{{ route('order.track.form') }}" class="{{ request()->routeIs('order.track*') ? 'active' : '' }}"><i class="bi bi-truck"></i><span>Track</span></a>
        @if(!empty($settings['phone']))
            <a href="tel:{{ preg_replace('/\s+/', '', $settings['phone']) }}"><i class="bi bi-telephone"></i><span>Call</span></a>
        @endif
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/store.js') }}?v=3"></script>
    @stack('scripts')
</body>
</html>
