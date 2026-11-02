@php
    $waNum = \App\Models\Setting::whatsappNumber();
    $tel   = preg_replace('/\s+/', '', (string) ($settings['phone'] ?? ''));
@endphp
<footer class="site-footer">
    <div class="container-xl footer-main">
        <div class="row g-4 g-lg-5">

            {{-- 1st column: logo, brand name, description --}}
            <div class="col-12 col-md-5">
                <div class="footer-brand">
                    <img src="{{ \App\Models\Setting::logoUrl() }}" alt="{{ $settings['site_name'] }}">
                    <h5>{{ $settings['site_name'] }}</h5>
                </div>
                <p class="footer-about" style="margin-bottom: 10px;">{{ $settings['footer_about'] }}</p>
                <div class="social">
                    @if(!empty($settings['facebook_url']))<a href="{{ $settings['facebook_url'] }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="bi bi-facebook"></i></a>@endif
                    @if($waNum)<a href="https://wa.me/{{ $waNum }}" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>@endif
                    @if(!empty($settings['youtube_url']))<a href="{{ $settings['youtube_url'] }}" target="_blank" rel="noopener" aria-label="YouTube"><i class="bi bi-youtube"></i></a>@endif
                    @if(!empty($settings['tiktok_url']))<a href="{{ $settings['tiktok_url'] }}" target="_blank" rel="noopener" aria-label="TikTok"><i class="bi bi-tiktok"></i></a>@endif
                </div>
            </div>

            {{-- 2nd column: links --}}
            <div class="col-4 col-md-2">
                <div class="footer-title">Links</div>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right"></i> হোম</a></li>
                    <li><a href="{{ route('search') }}"><i class="bi bi-chevron-right"></i> সব পণ্য</a></li>
                    <li><a href="{{ route('order.track.form') }}"><i class="bi bi-chevron-right"></i> অর্ডার ট্র্যাক</a></li>
                    @if($waNum)<li><a href="https://wa.me/{{ $waNum }}" target="_blank" rel="noopener"><i class="bi bi-chevron-right"></i> Help Center</a></li>@endif
                </ul>
            </div>

            {{-- 3rd column: contact info + social icons --}}
            <div class="col-8 col-md-5">
                <div class="footer-title">Contact</div>
                <ul class="footer-contact">
                    @if($tel !== '')<li><i class="bi bi-telephone"></i><a href="tel:{{ $tel }}">{{ $settings['phone'] }}</a></li>@endif
                    <li><i class="bi bi-envelope"></i><span>contact@takbirgadgets.com</span></li>
                    @if(!empty($settings['address']))<li><i class="bi bi-geo-alt"></i><span>{{ $settings['address'] }}</span></li>@endif

                </ul>
                
            </div>
        </div>
    </div>

    {{-- Copyright: two columns --}}
    <div class="footer-bottom">
        <div class="container-xl">
            <div class="copy">© {{ date('Y') }} {{ $settings['site_name'] }} — All Rights Reserved</div>
            <div class="dev">Developed by <strong>Shekh Mohsin</strong></div>
        </div>
    </div>
</footer>
