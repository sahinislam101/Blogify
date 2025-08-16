<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AboutController extends Controller
{
    public function index(){
        $categories = Category::where('status',1)->latest()->take(8)->get();
        return Inertia::render('About',[
            'categories' =>$categories
        ]);
    }
}
