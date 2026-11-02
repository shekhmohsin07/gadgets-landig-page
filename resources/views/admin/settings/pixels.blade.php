@extends('admin.layout')
@section('title', 'Pixel setup')
@section('content')
<h1 class="h4 fw-bold mb-1">Pixel setup</h1>
<p class="text-muted">Paste your IDs and the tracking code is added to every storefront page automatically. The admin panel is never tracked.</p>

<form method="post" action="{{ route('admin.settings.pixels.save') }}" style="max-width:860px">
    @csrf

    <div class="card mb-3"><div class="card-body">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="pixel_enabled" value="1" id="pe" @checked(old('pixel_enabled', $values['pixel_enabled']) == '1')>
            <label class="form-check-label fw-semibold" for="pe">Enable tracking on the website</label>
        </div>
        <div class="form-text">Turn off to pause every pixel below without deleting the IDs.</div>
    </div></div>

    <div class="card mb-3"><div class="card-body">
        <h2 class="h6 fw-bold"><i class="bi bi-facebook text-primary me-1"></i> Meta (Facebook) Pixel</h2>
        <label class="form-label">Pixel ID</label>
        <input name="fb_pixel_id" class="form-control" placeholder="123456789012345" value="{{ old('fb_pixel_id', $values['fb_pixel_id']) }}">
        <div class="form-text">Events Manager → Data sources → your Pixel → the numeric ID.</div>
    </div></div>

    <div class="card mb-3"><div class="card-body">
        <h2 class="h6 fw-bold"><i class="bi bi-tiktok me-1"></i> TikTok Pixel</h2>
        <label class="form-label">Pixel ID</label>
        <input name="tiktok_pixel_id" class="form-control" placeholder="C1ABCDEF2GHIJ3KLMNO" value="{{ old('tiktok_pixel_id', $values['tiktok_pixel_id']) }}">
    </div></div>

    <div class="card mb-3"><div class="card-body">
        <h2 class="h6 fw-bold"><i class="bi bi-google text-danger me-1"></i> Google</h2>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Google Analytics 4 Measurement ID</label>
                <input name="ga4_id" class="form-control" placeholder="G-XXXXXXXXXX" value="{{ old('ga4_id', $values['ga4_id']) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Google Tag Manager container ID</label>
                <input name="gtm_id" class="form-control" placeholder="GTM-XXXXXXX" value="{{ old('gtm_id', $values['gtm_id']) }}">
            </div>
        </div>
        <div class="form-text mt-2">If you load GA4 <em>inside</em> Tag Manager, leave the GA4 field empty here to avoid counting every visit twice.</div>
    </div></div>

    <div class="card mb-3"><div class="card-body">
        <h2 class="h6 fw-bold"><i class="bi bi-code-slash me-1"></i> Custom code (advanced)</h2>
        <div class="mb-3">
            <label class="form-label">Inside &lt;head&gt;</label>
            <textarea name="custom_head_code" rows="4" class="form-control font-monospace small" placeholder="Other pixels, Search Console verification meta tag, etc.">{{ old('custom_head_code', $values['custom_head_code']) }}</textarea>
        </div>
        <div>
            <label class="form-label">After opening &lt;body&gt;</label>
            <textarea name="custom_body_code" rows="3" class="form-control font-monospace small">{{ old('custom_body_code', $values['custom_body_code']) }}</textarea>
        </div>
        <div class="form-text">Only paste code from sources you trust — it runs on every visitor's browser.</div>
    </div></div>

    <div class="card mb-3"><div class="card-body">
        <h2 class="h6 fw-bold">Events sent automatically</h2>
        <div class="table-responsive">
        <table class="table table-sm mb-0 small">
            <thead><tr><th>When</th><th>Meta</th><th>TikTok</th><th>GA4</th><th>GTM dataLayer</th></tr></thead>
            <tbody>
                <tr><td>Any page opens</td><td>PageView</td><td>page()</td><td>page_view</td><td>—</td></tr>
                <tr><td>Landing page opens</td><td>ViewContent</td><td>ViewContent</td><td>view_item</td><td>gc_viewcontent</td></tr>
                <tr><td>Visitor starts the order form</td><td>InitiateCheckout</td><td>InitiateCheckout</td><td>begin_checkout</td><td>gc_initiatecheckout</td></tr>
                <tr><td>Order placed (thank-you page)</td><td>Purchase</td><td>CompletePayment</td><td>purchase</td><td>gc_purchase</td></tr>
            </tbody>
        </table>
        </div>
        <div class="form-text mt-2">Value is sent in BDT. Check with Meta Pixel Helper / TikTok Pixel Helper after saving.</div>
    </div></div>

    <button class="btn btn-brand px-4">Save pixel settings</button>
</form>
@endsection
