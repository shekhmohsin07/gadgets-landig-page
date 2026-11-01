@if(($settings['pixel_enabled'] ?? '1') === '1')
    @if(!empty($settings['gtm_id']))
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $settings['gtm_id'] }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif
    @if(!empty($settings['custom_body_code']))
        {!! $settings['custom_body_code'] !!}
    @endif
@endif
