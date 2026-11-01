<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>@yield('title', 'Admin') · {{ $settings['site_name'] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root { --brand: {{ $settings['primary_color'] ?: '#1558d6' }}; --accent: {{ $settings['accent_color'] ?: '#25b84c' }}; }
        body { background: #f3f6fb; }
        .sidebar { width: 240px; background: var(--brand); min-height: 100vh; position: sticky; top: 0; align-self: flex-start; }
        .sidebar .brand { color: #fff; font-weight: 700; font-size: 1.15rem; padding: 1rem 1.1rem; display: block; }
        .sidebar a.nav-link { color: rgba(255,255,255,.85); padding: .6rem 1.1rem; border-radius: 0; }
        .sidebar a.nav-link:hover, .sidebar a.nav-link.active { background: rgba(255,255,255,.14); color: #fff; }
        .sidebar .nav-label { color: rgba(255,255,255,.55); font-size: .7rem; text-transform: uppercase; letter-spacing: .06em; padding: .9rem 1.1rem .2rem; }
        .btn-brand { background: var(--brand); border-color: var(--brand); color: #fff; }
        .btn-brand:hover { background: color-mix(in srgb, var(--brand) 80%, #000); color: #fff; }
        .card { border: 0; box-shadow: 0 1px 6px rgba(20,40,80,.07); border-radius: 12px; }
        .thumb { width: 52px; height: 52px; object-fit: cover; border-radius: 8px; background: #fff; border: 1px solid #e6eaf0; }
        .stat { font-size: 1.7rem; font-weight: 700; }
        @media (max-width: 991px) { .sidebar { width: 100%; min-height: auto; position: static; } .layout { flex-direction: column; } }
    </style>
</head>
<body>
@php $r = fn ($p) => request()->routeIs($p) ? 'active' : ''; @endphp
<div class="d-flex layout">
    <aside class="sidebar">
        <a class="brand" href="{{ route('admin.dashboard') }}"><i class="bi bi-lightning-charge-fill"></i> {{ $settings['site_name'] }}</a>
        <nav class="nav flex-column">
            <a class="nav-link {{ $r('admin.dashboard') }}" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
            <a class="nav-link {{ $r('admin.orders.*') }}" href="{{ route('admin.orders.index') }}"><i class="bi bi-receipt me-2"></i>Orders</a>
            <div class="nav-label">Catalog</div>
            <a class="nav-link {{ $r('admin.products.*') }}" href="{{ route('admin.products.index') }}"><i class="bi bi-box-seam me-2"></i>Products / Landing pages</a>
            <a class="nav-link {{ $r('admin.banners.*') }}" href="{{ route('admin.banners.index') }}"><i class="bi bi-images me-2"></i>Home banners</a>
            <a class="nav-link {{ $r('admin.testimonials.*') }}" href="{{ route('admin.testimonials.index') }}"><i class="bi bi-chat-quote me-2"></i>Customer reviews</a>
            <div class="nav-label">Settings</div>
            <a class="nav-link {{ $r('admin.settings.general') }}" href="{{ route('admin.settings.general') }}"><i class="bi bi-gear me-2"></i>General</a>
            <a class="nav-link {{ $r('admin.settings.pixels') }}" href="{{ route('admin.settings.pixels') }}"><i class="bi bi-bullseye me-2"></i>Pixel setup</a>
            <a class="nav-link {{ $r('admin.settings.account') }}" href="{{ route('admin.settings.account') }}"><i class="bi bi-key me-2"></i>Change password</a>
            <div class="nav-label">&nbsp;</div>
            <a class="nav-link" href="{{ route('home') }}" target="_blank"><i class="bi bi-box-arrow-up-right me-2"></i>View website</a>
            <form action="{{ route('admin.logout') }}" method="post" class="m-0">@csrf
                <button class="nav-link w-100 text-start border-0 bg-transparent"><i class="bi bi-box-arrow-left me-2"></i>Logout</button>
            </form>
        </nav>
    </aside>

    <div class="flex-grow-1 p-3 p-lg-4" style="min-width:0">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show py-2">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger py-2"><ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif
        @yield('content')
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
