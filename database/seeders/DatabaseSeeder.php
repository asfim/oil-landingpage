<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin', 'password' => \Illuminate\Support\Facades\Hash::make('password')]
        );

        $settings = [
            'site_title' => 'NOVA — Power your everyday',
            'site_description' => 'NOVA প্রিমিয়াম টেক ও ভেষজ প্রোডাক্টস — ক্যাশ অন ডেলিভারি সহ দ্রুত ডেলিভারি।',
            'hero_title' => 'আপনার প্রতিদিনকে <em>পাওয়ার আপ</em> করুন',
            'hero_description' => 'প্রিমিয়াম সাউন্ড, স্মার্ট ট্র্যাকিং আর সারাদিনের চার্জ — একসাথে, একটাই ব্র্যান্ডে। NOVA-র ৪টি ফ্ল্যাগশিপ প্রোডাক্ট এখন বিশেষ ছাড়ে।',
            'hero_rating' => '৪.৮/৫',
            'delivery_charge' => '60'
        ];

        foreach ($settings as $key => $value) {
            \App\Models\Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        $whyItems = [
            [
                'title' => 'মানের নিশ্চয়তা',
                'description' => 'প্রতিটি প্রোডাক্ট কোয়ালিটি চেক করে পাঠানো হয়।',
                'icon' => '<path d="M12 2l8 4v6c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6l8-4z"/><path d="M9 12l2 2 4-4"/>',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'ফাস্ট ডেলিভারি',
                'description' => 'ঢাকার ভিতরে ২৪-৪৮ ঘণ্টার মধ্যে ডেলিভারি।',
                'icon' => '<path d="M5 12h14M12 5l7 7-7 7"/>',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'সহজ অর্ডার',
                'description' => 'মাত্র কয়েকটি ক্লিকে অর্ডার সম্পন্ন করুন।',
                'icon' => '<circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'কাস্টমার সাপোর্ট',
                'description' => 'যেকোনো প্রশ্নে আমাদের টিম সবসময় পাশে আছে।',
                'icon' => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'নিরাপদ পেমেন্ট',
                'description' => 'ক্যাশ অন ডেলিভারি সহ নিরাপদ পেমেন্ট অপশন।',
                'icon' => '<rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'সিকিউর প্যাকেজিং',
                'description' => 'প্রতিটি প্রোডাক্ট নিরাপদে প্যাক করে পাঠানো হয়।',
                'icon' => '<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/>',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($whyItems as $item) {
            \App\Models\WhyChooseItem::updateOrCreate(
                ['title' => $item['title']],
                $item
            );
        }
    }
}
