<footer class="site-footer">
    <div class="container-xl py-4">
        <h5 class="fw-bold mb-2">{{ $settings['site_name'] }}</h5>
        <p class="small opacity-90 mb-3">{{ $settings['footer_about'] }}</p>

        <div class="social mb-4">
            @if(!empty($settings['facebook_url']))<a href="{{ $settings['facebook_url'] }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="bi bi-facebook"></i></a>@endif
            @if(\App\Models\Setting::whatsappNumber())<a href="https://wa.me/{{ \App\Models\Setting::whatsappNumber() }}" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>@endif
            @if(!empty($settings['youtube_url']))<a href="{{ $settings['youtube_url'] }}" target="_blank" rel="noopener" aria-label="YouTube"><i class="bi bi-youtube"></i></a>@endif
            @if(!empty($settings['tiktok_url']))<a href="{{ $settings['tiktok_url'] }}" target="_blank" rel="noopener" aria-label="TikTok"><i class="bi bi-tiktok"></i></a>@endif
        </div>

        <div class="row g-4 small">
            <div class="col-6">
                <div class="fw-semibold mb-2">Links</div>
                <ul class="list-unstyled mb-0 footer-links">
                    <li><a href="{{ route('home') }}">হোম</a></li>
                    <li><a href="{{ route('search') }}">সব পণ্য</a></li>
                </ul>
            </div>
            <div class="col-6">
                <div class="fw-semibold mb-2">Support</div>
                <ul class="list-unstyled mb-0 footer-links">
                    @if(\App\Models\Setting::whatsappNumber())<li><a href="https://wa.me/{{ \App\Models\Setting::whatsappNumber() }}" target="_blank" rel="noopener">Help Center</a></li>@endif
                    @if(!empty($settings['phone']))<li><a href="tel:{{ preg_replace('/\s+/', '', $settings['phone']) }}">Contact</a></li>@endif
                </ul>
            </div>
            <div class="col-12">
                <div class="fw-semibold mb-2">Contacts</div>
                <div>{{ $settings['phone'] }}</div>
                <div>{{ $settings['address'] }}</div>
            </div>
        </div>

        <hr class="border-light opacity-25 my-3">
        <div class="text-center small opacity-90">© {{ date('Y') }} {{ $settings['site_name'] }} — All Rights Reserved</div>
    </div>
</footer>
