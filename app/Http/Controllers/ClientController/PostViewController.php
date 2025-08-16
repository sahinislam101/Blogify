<?php

namespace App\Http\Controllers\ClientController;

use App\Models\Post;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostViewController extends Controller
{
    public function view($slug){
        $categories = Category::where('status',1)->withCount('posts')->latest()->take(8)->get();
        $post = Post::with(['user', 'category'])->findOrFail($slug);
        
        return Inertia::render('PostView',[
            'categories' => $categories,
            'post' => $post,
        ]);
    }
}
