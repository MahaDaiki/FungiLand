<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'Adventure',
            'Nature',
            'Travel',
            'Exploration',
            'Hiking',
            'Camping',
            'Photography',
            'Wildlife',
            'Landscape',
            'Outdoor',
            'Scenic',
            'Mountains',
            'Beach',
            'Forest',
            'River',
            'Lake',
            'Waterfall',
            'Sunset',
            'mushrooms',
            'insects',
            'bugs',
            'Sunrise',
            'Flower',
            'Plant',
            'Tree',
            'Animal',
            'Bird',
            'Insect',
            'Ocean',
            'Desert',
            'Island',
            'Nature Photography',
            'Wanderlust',
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag,
            ]);
        }
    }
    
}
