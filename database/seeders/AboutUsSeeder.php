<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AboutUs;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default English about us content
        AboutUs::updateOrCreate(
            ['language' => 'en'],
            [
                'content' => 'Discover our commitment to sustainable luxury and exceptional hospitality. We blend eco-friendly practices with world-class amenities to create memorable experiences for our valued guests.',
                'is_active' => true,
            ]
        );
        
        // Create default Bengali about us content
        AboutUs::updateOrCreate(
            ['language' => 'bn'],
            [
                'content' => 'টেকসই লাক্সারি এবং অসাধারণ হস্পিটালিটির প্রতি আমাদের প্রতিশ্রুতি আবিষ্কার করুন। আমরা পরিবেশ বান্ধব অনুশীলনি এবং বিশ্ব-শ্রেণির সুবিধাগুলিকে সংযুক্ত করি যাতে আমাদের মূল্যবান অতিথিদের জন্য স্মরণীয় অভিজ্ঞতা তৈরি হয়।',
                'is_active' => true,
            ]
        );
    }
}
