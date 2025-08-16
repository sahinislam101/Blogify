<?php

namespace App\Http\Controllers\ClientController;

use App\Models\Post;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostCategoryController extends Controller
{
    public function show($slug)
    {
        
        $category = Category::where('slug', $slug)
            ->where('status', 1)
            ->with(['posts' => function ($q) {
                $q->where('status', 1)->with('user', 'category')->latest();
            }])
            ->firstOrFail();

        
        $categories = Category::where('status', 1)->withCount('posts')->latest()->take(8)->get();

        return Inertia::render('Home', [
            'categories' => $categories,
            'posts' => $category->posts, 
        ]);
    }
}
