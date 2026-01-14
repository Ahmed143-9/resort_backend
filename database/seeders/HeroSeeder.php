<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hero;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default English hero content
        Hero::updateOrCreate(
            ['language' => 'en'],
            [
                'subtitle' => 'Whisper of the Forest',
                'title' => 'OWN A PIECE\nOF THE EARTH',
                'description' => 'A fractional ownership model secured by land, engineered for yield, and designed for legacy.',
                'is_active' => true,
            ]
        );
        
        // Create default Bengali hero content
        Hero::updateOrCreate(
            ['language' => 'bn'],
            [
                'subtitle' => 'অরণ্যের স্নিগ্ধ স্পন্দন',
                'title' => 'গড়ে তুলুন নিজের\nএক টুকরো পৃথিবী',
                'description' => 'সাফ কবলা দলিলে জমির মালিকানা ও নিশ্চিত আয়ের এক যুগান্তকারী মডেল, যা আপনার এবং আপনার পরবর্তী প্রজন্মের জন্য এক গর্বিত উত্তরাধিকার।',
                'is_active' => true,
            ]
        );
    }
}
