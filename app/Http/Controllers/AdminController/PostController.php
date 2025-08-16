<?php

namespace App\Http\Controllers\AdminController;

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\Post\StorePostRequest as StorePostRequest;
use App\Http\Requests\AdminRequest\Post\UpdatePostRequest as UpdatePostRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::with('category')
            ->when(
                $request->search,
                fn($q) =>
                $q->where('title', 'like', "%{$request->search}%")
            )
            ->when(
                $request->status,
                fn($q, $status) =>
                $q->where('status', $status === 'active')
            )
            ->latest();

        return Inertia::render('admin_pages/post/Index', [
            'posts' => $query->paginate(10)->withQueryString(),
            'filters' => $request->only('search', 'status'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->where('status', 1)->get();
        return Inertia::render('admin_pages/post/Create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {

    // dd(Auth::check(), Auth::id());
        Post::create($request->validated());

    return redirect()->route('posts.index')->with('success', 'Post Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {

        return Inertia::render('admin_pages/post/Edit', [
            'post' => $post,
            'categories' => Category::select('id', 'name')->get(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());

        return redirect()->route('posts.index')
            ->with('success', 'Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post Deleted Successfully');
    }
}
