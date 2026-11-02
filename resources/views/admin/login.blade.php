<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>Admin login · {{ $settings['site_name'] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #0a0a0a 45%, {{ $settings['primary_color'] ?: '#e30000' }}); min-height: 100vh; display: flex; align-items: center; }
        .box { max-width: 400px; width: 100%; margin: 0 auto; background: #fff; border-radius: 16px; padding: 28px; box-shadow: 0 10px 40px rgba(0,0,0,.25); }
    </style>
</head>
<body>
<div class="container">
    <div class="box">
        <img src="{{ \App\Models\Setting::logoUrl() }}" alt="" style="height:64px;border-radius:14px" class="mb-2">
        <h1 class="h4 fw-bold mb-1">{{ $settings['site_name'] }}</h1>
        <p class="text-muted small mb-4">Admin dashboard login</p>
        <form method="post" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required autofocus>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" name="remember" value="1" class="form-check-input" id="remember">
                <label for="remember" class="form-check-label">Remember me</label>
            </div>
            <button class="btn w-100 text-white" style="background:{{ $settings['primary_color'] ?: '#e30000' }}">Sign in</button>
        </form>
    </div>
</div>
</body>
</html>
