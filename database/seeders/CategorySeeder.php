<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Technology',
            'Health',
            'Sports',
            'Education',
            'Travel',
            'Food',
            'Entertainment',
        ];

        foreach ($categories as $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => 'This is the ' . $name . ' category.',
                'status' => true,
            ]);
        }
    }
}
