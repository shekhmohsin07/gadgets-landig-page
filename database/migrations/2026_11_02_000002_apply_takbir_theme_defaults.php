<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Moves sites that still hold the old "Gadget Care" blue/green defaults to the
 * Takbir Gadgets red/black theme. A value you changed yourself in
 * Admin → General is never touched (only exact old defaults are replaced).
 */
return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('settings')) {
            return;
        }

        $replace = [
            'primary_color'    => ['#1558d6' => '#e30000'],
            'accent_color'     => ['#25b84c' => '#0a0a0a'],
            'site_name'        => ['Gadget Care' => 'Takbir Gadgets'],
            'meta_description' => [
                'Gadget Care - original gadgets at the best price. Cash on delivery all over Bangladesh.'
                    => 'Takbir Gadgets - original gadgets at the best price. Cash on delivery all over Bangladesh.',
            ],
            'footer_about'     => [
                'আপনার গ্যাজেট পার্টনার! আভিজাত্য, আধুনিকতা ও নতুন প্রযুক্তিগুলি সবার হাতের মুঠোয়, ফ্রি ডেলিভারি সহ।'
                    => 'আপনার বিশ্বস্ত গ্যাজেট শপ! আধুনিক ও মানসম্মত গ্যাজেট, সেরা দামে — সারা বাংলাদেশে ক্যাশ অন ডেলিভারি।',
            ],
        ];

        foreach ($replace as $key => $pairs) {
            foreach ($pairs as $old => $new) {
                DB::table('settings')->where('key', $key)->where('value', $old)->update(['value' => $new]);
            }
        }
    }

    public function down(): void
    {
        // Intentionally empty: theme values are plain settings and can be edited in the admin panel.
    }
};
