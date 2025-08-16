<?php

namespace App\Http\Controllers\ClientController;

use App\Models\Post;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Request $request){
        
        $categories = Category::where('status',1)->withCount('posts')->latest()->take(8)->get();
        $posts = Post::with(['user', 'category'])->where('status',1)->latest()->get();
        return Inertia::render('Home',[
            'categories' =>$categories,
            'posts' => $posts,
        ]);
    }
}


