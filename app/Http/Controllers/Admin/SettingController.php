<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Support\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function general()
    {
        return view('admin.settings.general', ['values' => Setting::allValues()]);
    }

    public function saveGeneral(Request $request)
    {
        $data = $request->validate([
            'site_name'        => ['required', 'string', 'max:80'],
            'meta_description' => ['nullable', 'string', 'max:300'],
            'footer_about'     => ['nullable', 'string', 'max:500'],
            'phone'            => ['nullable', 'string', 'max:30'],
            'whatsapp_number'  => ['nullable', 'string', 'max:30'],
            'address'          => ['nullable', 'string', 'max:200'],
            'facebook_url'     => ['nullable', 'url', 'max:255'],
            'youtube_url'      => ['nullable', 'url', 'max:255'],
            'tiktok_url'       => ['nullable', 'url', 'max:255'],
            'delivery_inside'  => ['required', 'integer', 'min:0'],
            'delivery_outside' => ['required', 'integer', 'min:0'],
            'primary_color'    => ['required', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'accent_color'     => ['required', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'logo'             => ['nullable', 'image', 'max:3072'],
        ]);

        unset($data['logo']);
        if ($request->hasFile('logo')) {
            Upload::delete(Setting::get('site_logo'));
            $data['site_logo'] = Upload::image($request->file('logo'), 'site');
        } elseif ($request->boolean('remove_logo')) {
            Upload::delete(Setting::get('site_logo'));
            $data['site_logo'] = '';
        }

        Setting::setMany(array_map(fn ($v) => $v ?? '', $data));

        return back()->with('success', 'Settings saved.');
    }

    public function pixels()
    {
        return view('admin.settings.pixels', ['values' => Setting::allValues()]);
    }

    public function savePixels(Request $request)
    {
        $data = $request->validate([
            'fb_pixel_id'      => ['nullable', 'regex:/^\d{5,20}$/'],
            'tiktok_pixel_id'  => ['nullable', 'regex:/^[A-Za-z0-9]{6,40}$/'],
            'ga4_id'           => ['nullable', 'regex:/^G-[A-Za-z0-9]{4,20}$/'],
            'gtm_id'           => ['nullable', 'regex:/^GTM-[A-Za-z0-9]{4,12}$/'],
            'custom_head_code' => ['nullable', 'string', 'max:20000'],
            'custom_body_code' => ['nullable', 'string', 'max:20000'],
        ], [
            'fb_pixel_id.regex'     => 'Facebook Pixel ID must be digits only (e.g. 123456789012345).',
            'tiktok_pixel_id.regex' => 'TikTok Pixel ID should be letters and numbers only (e.g. C1ABCDEF2GHIJ3).',
            'ga4_id.regex'          => 'GA4 Measurement ID looks like G-XXXXXXXXXX.',
            'gtm_id.regex'          => 'GTM container ID looks like GTM-XXXXXXX.',
        ]);

        $data = array_map(fn ($v) => trim((string) $v), $data);
        $data['pixel_enabled'] = $request->boolean('pixel_enabled') ? '1' : '0';

        Setting::setMany($data);

        return back()->with('success', 'Pixel settings saved.');
    }

    public function account()
    {
        return view('admin.settings.account');
    }

    public function saveAccount(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();
        $user->password = $request->input('password');
        $user->save();

        return back()->with('success', 'Password changed.');
    }
}
