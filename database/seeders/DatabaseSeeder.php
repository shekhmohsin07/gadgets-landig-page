<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ---- First admin account (change the password after first login) ----
        User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@gadgetcare.shop')],
            [
                'name'     => env('ADMIN_NAME', 'Admin'),
                'password' => env('ADMIN_PASSWORD', 'ChangeMe@123'),
                'is_admin' => true,
            ]
        );

        // ---- Default site settings (only inserted if missing) ----
        foreach (Setting::defaults() as $key => $value) {
            Setting::query()->firstOrCreate(['key' => $key], ['value' => $value]);
        }

        if (Product::exists()) {
            return; // don't overwrite a live catalogue
        }

        Banner::create(['title' => 'Welcome', 'image' => 'images/banners/welcome.svg', 'sort_order' => 1, 'is_active' => true]);

        // ---- Top selling products (4 full landing pages) ----
        $products = [
            [
                'name' => 'Red Light Scalp Massager 100% Orjinal', 'price' => 750, 'old_price' => 1250, 'badge' => 'Best Selling',
                'image' => 'images/products/scalp-massager.svg', 'rating' => 4.9, 'reviews_count' => 128, 'top' => true, 'popular' => false,
                'description' => "৫ মিনিটে মাথা ব্যথা দূর করুন Original Scalp Massager দিয়ে।\n\n✅ রেড লাইট থেরাপি ও ভাইব্রেশন মাসাজ\n✅ Low, Medium, High — ৩টি স্পিড মোড\n✅ রিচার্জেবল ব্যাটারি, দীর্ঘ সময় ব্যাকআপ\n✅ চুল ও স্ক্যাল্পের জন্য আরামদায়ক সিলিকন হেড\n\nপণ্য হাতে পেয়ে চেক করে টাকা পরিশোধ করুন (ক্যাশ অন ডেলিভারি)। অর্ডার করতে নিচের ফর্মটি পূরণ করুন।",
            ],
            [
                'name' => 'Blackhead Remover + Hair Oil Applicator Comb', 'price' => 849, 'old_price' => 1250, 'badge' => 'Best Selling',
                'image' => 'images/products/blackhead-remover.svg', 'rating' => 4.9, 'reviews_count' => 0, 'top' => true, 'popular' => false,
                'description' => "ব্ল্যাকহেড রিমুভার + হেয়ার অয়েল অ্যাপ্লিকেটর কম্ব — একটি ডিভাইসে দুই কাজ।\n\n✅ মাল্টি-ফাংশনাল ক্লিনিং ডিভাইস\n✅ একাধিক সাকশন হেড\n✅ স্ক্যাল্পে তেল লাগানোর জন্য অ্যাপ্লিকেটর চিরুনি\n\nক্যাশ অন ডেলিভারি — পণ্য হাতে পেয়ে মূল্য পরিশোধ করুন।",
            ],
            [
                'name' => '3 Head Fascia Massage Gun – With 9 Difference Heads – 100% Original', 'price' => 999, 'old_price' => 1650, 'badge' => 'Hot Deal',
                'image' => 'images/products/massage-gun.svg', 'rating' => 4.9, 'reviews_count' => 0, 'top' => true, 'popular' => false,
                'description' => "পেশীর ব্যথা ও আড়ষ্টতা কমাতে ফ্যাসিয়া মাসাজ গান।\n\n✅ ৯টি ভিন্ন মাসাজ হেড\n✅ একাধিক স্পিড লেভেল\n✅ হালকা ও সহজে বহনযোগ্য\n\nক্যাশ অন ডেলিভারি — পণ্য হাতে পেয়ে মূল্য পরিশোধ করুন।",
            ],
            [
                'name' => '🔥 6500 WT Power 🔥 Silver Crest RAK Electric Grinder Blender', 'price' => 1050, 'old_price' => 1800, 'badge' => 'Hot Deal',
                'image' => 'images/products/grinder.svg', 'rating' => 4.9, 'reviews_count' => 0, 'top' => true, 'popular' => false,
                'description' => "শক্তিশালী মোটরের ইলেকট্রিক গ্রাইন্ডার ও ব্লেন্ডার।\n\n✅ মশলা, ডাল, শুকনো ও ভেজা পণ্য পিষতে সক্ষম\n✅ স্টেইনলেস স্টিল বডি\n✅ সহজে পরিষ্কার করা যায়\n\nক্যাশ অন ডেলিভারি — পণ্য হাতে পেয়ে মূল্য পরিশোধ করুন।",
            ],
            // ---- Popular products ----
            ['name' => 'Prestige 3.2 Liter Electric Multi cooker', 'price' => 989, 'old_price' => 1260, 'image' => 'images/products/multi-cooker.svg', 'top' => false, 'popular' => true],
            ['name' => 'Hoco MMJ-24 TWS Wireless Earbuds', 'price' => 990, 'old_price' => 1650, 'image' => 'images/products/earbuds.svg', 'top' => false, 'popular' => true],
            ['name' => 'Osaka Electric Chopper', 'price' => 950, 'old_price' => 1650, 'image' => 'images/products/chopper.svg', 'top' => false, 'popular' => true],
            ['name' => '40000 mAh Battery High Power Chaina Jambu Light', 'price' => 1150, 'old_price' => 2600, 'image' => 'images/products/power-light.svg', 'top' => false, 'popular' => true],
            ['name' => 'Handheld Portable Turbo Mini Fan', 'price' => 599, 'old_price' => 1250, 'image' => 'images/products/mini-fan.svg', 'top' => false, 'popular' => true],
        ];

        foreach ($products as $i => $p) {
            Product::create([
                'slug'           => Product::uniqueSlug($p['name']),
                'name'           => $p['name'],
                'price'          => $p['price'],
                'old_price'      => $p['old_price'],
                'badge'          => $p['badge'] ?? null,
                'image'          => $p['image'],
                'description'    => $p['description'] ?? "এই পণ্যটি সম্পর্কে বিস্তারিত জানতে বা অর্ডার করতে নিচের ফর্মটি পূরণ করুন। ক্যাশ অন ডেলিভারি — পণ্য হাতে পেয়ে মূল্য পরিশোধ করুন।",
                'rating'         => $p['rating'] ?? 4.9,
                'reviews_count'  => $p['reviews_count'] ?? 0,
                'is_top_selling' => $p['top'],
                'is_popular'     => $p['popular'],
                'is_active'      => true,
                'sort_order'     => $i,
            ]);
        }

        // One real review taken from the existing site; add the rest from the admin panel.
        Testimonial::create([
            'name'       => 'Fatema Akter',
            'handle'     => '@fatema_student',
            'message'    => 'iPad Keyboard Case টা পেয়ে পড়াশোনা অনেক সহজ হয়ে গেছে। দাম তুলনামূলক অনেক কম।',
            'rating'     => 5,
            'sort_order' => 1,
            'is_active'  => true,
        ]);
    }
}
