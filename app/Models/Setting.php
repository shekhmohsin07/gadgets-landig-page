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
            'site_name'        => 'Gadget Care',
            'site_logo'        => '',
            'meta_description' => 'Gadget Care - original gadgets at the best price. Cash on delivery all over Bangladesh.',
            'footer_about'     => 'আপনার গ্যাজেট পার্টনার! আভিজাত্য, আধুনিকতা ও নতুন প্রযুক্তিগুলি সবার হাতের মুঠোয়, ফ্রি ডেলিভারি সহ।',
            'phone'            => '01348025532',
            'whatsapp_number'  => '01348025532',
            'address'          => 'Dhaka, Bangladesh',
            'facebook_url'     => '',
            'youtube_url'      => '',
            'tiktok_url'       => '',
            'delivery_inside'  => '101',
            'delivery_outside' => '101',
            'primary_color'    => '#1558d6',
            'accent_color'     => '#25b84c',

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
