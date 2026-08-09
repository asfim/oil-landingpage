<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'code' => 'jotno_1',
                'name' => '১ ফাইল — জতনো ভেষজ তেল (১০০ml)',
                'tagline' => 'ট্রায়াল প্যাক',
                'desc' => 'প্রাকৃতিক উপাদানে তৈরি ১ ফাইল ব্যথানাশক তেল।',
                'price' => 499.00,
                'old_price' => 990.00,
                'img' => 'jotno_bottle.png',
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'code' => 'jotno_2',
                'name' => '২ ফাইল — জতনো ভেষজ তেল (২০০ml)',
                'tagline' => 'জনপ্রিয় অফার প্যাক',
                'desc' => '২ ফাইলের স্পেশাল কম্বো প্যাক, দ্বিগুণ কার্যকারিতা।',
                'price' => 899.00,
                'old_price' => 1980.00,
                'img' => 'jotno_bottle.png',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'code' => 'jotno_3',
                'name' => '৩ ফাইল — জতনো ভেষজ তেল (৩০০ml)',
                'tagline' => 'ফ্যামিলি সেভার প্যাক',
                'desc' => 'পুরো পরিবারের জন্য ৩ ফাইলের বেস্ট ভ্যালু প্যাক।',
                'price' => 1250.00,
                'old_price' => 2970.00,
                'img' => 'jotno_bottle.png',
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'code' => 'jotno_4',
                'name' => '৪ ফাইল — জতনো ভেষজ তেল (৪০০ml)',
                'tagline' => 'মহা ধামাকা প্যাক',
                'desc' => '৪ ফাইলের সুপার ধামাকা ডিসকাউন্ট অফার।',
                'price' => 1599.00,
                'old_price' => 3960.00,
                'img' => 'jotno_bottle.png',
                'is_featured' => false,
                'is_active' => true,
            ],
        ];

        foreach ($products as $prod) {
            Product::updateOrCreate(
                ['code' => $prod['code']],
                $prod
            );
        }
    }
}
