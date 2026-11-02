@extends('admin.layout')
@section('title', 'General settings')
@section('content')
<h1 class="h4 fw-bold mb-3">General settings</h1>
<form method="post" enctype="multipart/form-data" action="{{ route('admin.settings.general.save') }}" style="max-width:820px">
    @csrf
    <div class="card mb-3"><div class="card-body">
        <h2 class="h6 fw-bold">Brand</h2>
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Site name *</label><input name="site_name" class="form-control" value="{{ old('site_name', $values['site_name']) }}" required></div>
            <div class="col-md-6">
                <label class="form-label">Logo (replaces the text name in the header)</label>
<<<<<<< HEAD
                <div class="mb-2"><img src="{{ \App\Models\Setting::logoUrl() }}" style="height:44px;border-radius:8px" alt=""> @if($values['site_logo'] && $values['site_logo'] !== 'images/logo.jpg')<label class="ms-2 small"><input type="checkbox" name="remove_logo" value="1"> use default Takbir Gadgets logo</label>@endif</div>
                <input type="file" name="logo" accept="image/*" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Brand color (buttons, prices, highlights)</label>
                <input type="color" name="primary_color" class="form-control form-control-color" value="{{ old('primary_color', $values['primary_color'] ?: '#e30000') }}">
                <div class="form-text">Red from the Takbir Gadgets logo.</div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Dark color (header, footer, call button)</label>
                <input type="color" name="accent_color" class="form-control form-control-color" value="{{ old('accent_color', $values['accent_color'] ?: '#0a0a0a') }}">
                <div class="form-text">Black from the logo.</div>
=======
                @if($values['site_logo'])<div class="mb-2"><img src="{{ asset($values['site_logo']) }}" style="height:40px" alt=""> <label class="ms-2 small"><input type="checkbox" name="remove_logo" value="1"> remove</label></div>@endif
                <input type="file" name="logo" accept="image/*" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Primary color (buttons, header text, footer)</label>
                <input type="color" name="primary_color" class="form-control form-control-color" value="{{ old('primary_color', $values['primary_color'] ?: '#1558d6') }}">
                <div class="form-text">Pick the blue from your logo.</div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Accent color (order / confirm buttons)</label>
                <input type="color" name="accent_color" class="form-control form-control-color" value="{{ old('accent_color', $values['accent_color'] ?: '#25b84c') }}">
                <div class="form-text">Pick the green from your logo.</div>
>>>>>>> affbddf8f8d532a5bdffe687b4b6384364a50c38
            </div>
            <div class="col-12"><label class="form-label">Meta description (Google / Facebook preview)</label><input name="meta_description" class="form-control" value="{{ old('meta_description', $values['meta_description']) }}"></div>
            <div class="col-12"><label class="form-label">Footer text</label><textarea name="footer_about" rows="2" class="form-control">{{ old('footer_about', $values['footer_about']) }}</textarea></div>
        </div>
    </div></div>

    <div class="card mb-3"><div class="card-body">
        <h2 class="h6 fw-bold">Contact &amp; social</h2>
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Phone</label><input name="phone" class="form-control" value="{{ old('phone', $values['phone']) }}"></div>
            <div class="col-md-6"><label class="form-label">WhatsApp number</label><input name="whatsapp_number" class="form-control" value="{{ old('whatsapp_number', $values['whatsapp_number']) }}"><div class="form-text">e.g. 01XXXXXXXXX — 88 is added automatically.</div></div>
            <div class="col-12"><label class="form-label">Address</label><input name="address" class="form-control" value="{{ old('address', $values['address']) }}"></div>
            <div class="col-md-4"><label class="form-label">Facebook URL</label><input name="facebook_url" class="form-control" value="{{ old('facebook_url', $values['facebook_url']) }}"></div>
            <div class="col-md-4"><label class="form-label">YouTube URL</label><input name="youtube_url" class="form-control" value="{{ old('youtube_url', $values['youtube_url']) }}"></div>
            <div class="col-md-4"><label class="form-label">TikTok URL</label><input name="tiktok_url" class="form-control" value="{{ old('tiktok_url', $values['tiktok_url']) }}"></div>
        </div>
    </div></div>

    <div class="card mb-3"><div class="card-body">
        <h2 class="h6 fw-bold">Delivery charge (৳)</h2>
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Inside Dhaka</label><input type="number" min="0" name="delivery_inside" class="form-control" value="{{ old('delivery_inside', $values['delivery_inside']) }}" required></div>
            <div class="col-md-6"><label class="form-label">Outside Dhaka</label><input type="number" min="0" name="delivery_outside" class="form-control" value="{{ old('delivery_outside', $values['delivery_outside']) }}" required></div>
        </div>
    </div></div>

    <button class="btn btn-brand px-4">Save settings</button>
</form>
@endsection
