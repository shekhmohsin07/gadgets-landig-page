<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'key';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['key', 'value'];

    protected static ?array $memo = null;

    /** Default values used until the admin saves something different. */
    public static function defaults(): array
    {
        return [
<<<<<<< HEAD
            'site_name'        => 'Takbir Gadgets',
            'site_logo'        => 'images/logo.jpg',
            'meta_description' => 'Takbir Gadgets - original gadgets at the best price. Cash on delivery all over Bangladesh.',
            'footer_about'     => 'আপনার বিশ্বস্ত গ্যাজেট শপ! আধুনিক ও মানসম্মত গ্যাজেট, সেরা দামে — সারা বাংলাদেশে ক্যাশ অন ডেলিভারি।',
            'phone'            => '',
            'whatsapp_number'  => '',
            'address'          => 'Bangladesh',
=======
            'site_name'        => 'Gadget Care',
            'site_logo'        => '',
            'meta_description' => 'Gadget Care - original gadgets at the best price. Cash on delivery all over Bangladesh.',
            'footer_about'     => 'আপনার গ্যাজেট পার্টনার! আভিজাত্য, আধুনিকতা ও নতুন প্রযুক্তিগুলি সবার হাতের মুঠোয়, ফ্রি ডেলিভারি সহ।',
            'phone'            => '01348025532',
            'whatsapp_number'  => '01348025532',
            'address'          => 'Dhaka, Bangladesh',
>>>>>>> affbddf8f8d532a5bdffe687b4b6384364a50c38
            'facebook_url'     => '',
            'youtube_url'      => '',
            'tiktok_url'       => '',
            'delivery_inside'  => '101',
            'delivery_outside' => '101',
<<<<<<< HEAD
            'primary_color'    => '#e30000',
            'accent_color'     => '#0a0a0a',
=======
            'primary_color'    => '#1558d6',
            'accent_color'     => '#25b84c',
>>>>>>> affbddf8f8d532a5bdffe687b4b6384364a50c38

            // Pixel / tracking
            'pixel_enabled'    => '1',
            'fb_pixel_id'      => '',
            'tiktok_pixel_id'  => '',
            'ga4_id'           => '',
            'gtm_id'           => '',
            'custom_head_code' => '',
            'custom_body_code' => '',
        ];
    }

    public static function allValues(): array
    {
        if (self::$memo === null) {
            try {
                $stored = self::query()->pluck('value', 'key')->all();
                self::$memo = array_merge(self::defaults(), array_map(fn ($v) => $v ?? '', $stored));
            } catch (\Throwable $e) {
                self::$memo = self::defaults();
            }
        }

        return self::$memo;
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        $all = self::allValues();

        return ($all[$key] ?? '') !== '' ? $all[$key] : $default;
    }

    public static function setMany(array $data): void
    {
        foreach ($data as $key => $value) {
            self::query()->updateOrInsert(['key' => $key], ['value' => $value]);
        }
        self::$memo = null;
    }

<<<<<<< HEAD
    /** Public URL of the logo (admin upload, or the bundled Takbir Gadgets logo). */
    public static function logoUrl(): string
    {
        $logo = (string) self::get('site_logo', 'images/logo.jpg');

        return asset($logo !== '' ? $logo : 'images/logo.jpg');
    }

=======
>>>>>>> affbddf8f8d532a5bdffe687b4b6384364a50c38
    /** WhatsApp number in international format for wa.me links (Bangladesh default). */
    public static function whatsappNumber(): string
    {
        $n = preg_replace('/\D+/', '', (string) self::get('whatsapp_number', self::get('phone', '')));
        if ($n === '') {
            return '';
        }
        if (str_starts_with($n, '0')) {
            $n = '88' . $n;
        } elseif (str_starts_with($n, '1') && strlen($n) === 10) {
            $n = '880' . $n;
        }

        return $n;
    }
}
