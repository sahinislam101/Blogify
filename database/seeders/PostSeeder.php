<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first(); 
        $categories = Category::all();

        if ($user && $categories->count()) {
            foreach ($categories as $category) {
                
                $postsCount = rand(8, 12);

                for ($i = 1; $i <= $postsCount; $i++) {
                    Post::create([
                        'user_id' => $user->id,
                        'category_id' => $category->id,
                        'title' => $category->name . ' Post ' . $i,
                        'slug' => Str::slug($category->name . ' Post ' . $i . '-' . Str::random(5)),
                        'content' => $this->generateContent(1000), // 1000 words
                        'status' => true,
                    ]);
                }
            }
        }
    }

    /**
     * Generate random content with given word count
     */
    private function generateContent(int $words = 1000): string
    {
        $text = [];
        for ($i = 0; $i < $words; $i++) {
            $text[] = Str::random(5); 
        }
        return implode(' ', $text);
    }
}
