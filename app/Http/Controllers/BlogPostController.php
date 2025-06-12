<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogPostRequest;
use App\Http\Resources\BlogPostResource;
use App\Http\Traits\HandlesImages;
use App\Models\BlogPost;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    use AuthorizesRequests, HandlesImages;

    public function index(Request $request)
    {
        $this->authorize('viewAny', BlogPost::class);

        $blogPosts = BlogPost::with(['categories', 'user']);
        
        if ($request->has('category_id')) {
            $blogPosts->where('categories_id', $request->category_id);
        }

        return BlogPostResource::collection($blogPosts->get());
    }

    public function store(BlogPostRequest $request)
    {
        $this->authorize('create', BlogPost::class);

        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            $data['image_path'] = $this->handleImageUpload($request->file('image'), 'blog-posts');
        }

        if ($request->hasFile('gallery')) {
            $data['galery'] = $this->handleMultipleImageUploads($request->file('gallery'), 'blog-posts/gallery');
        }

        $data['user_id'] = auth()->id();

        // Generate slugs if not provided
        if (!isset($data['slug']['en']) && isset($data['title']['en'])) {
            $data['slug']['en'] = Str::slug($data['title']['en']);
        }
        if (!isset($data['slug']['ro']) && isset($data['title']['ro'])) {
            $data['slug']['ro'] = Str::slug($data['title']['ro']);
        }

        $blogPost = BlogPost::create($data);

        return new BlogPostResource($blogPost->load(['categories', 'user']));
    }

    public function show(BlogPost $blogPost)
    {
        $this->authorize('view', $blogPost);

        return new BlogPostResource($blogPost->load(['categories', 'user']));
    }

    public function update(BlogPostRequest $request, BlogPost $blogPost)
    {
        $this->authorize('update', $blogPost);

        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            $this->deleteImage($blogPost->image_path);
            $data['image_path'] = $this->handleImageUpload($request->file('image'), 'blog-posts');
        }

        if ($request->hasFile('gallery')) {
            $this->deleteMultipleImages($blogPost->galery);
            $data['galery'] = $this->handleMultipleImageUploads($request->file('gallery'), 'blog-posts/gallery');
        }

        $blogPost->update($data);

        return new BlogPostResource($blogPost->load(['categories', 'user']));
    }

    public function destroy(BlogPost $blogPost)
    {
        $this->authorize('delete', $blogPost);

        $this->deleteImage($blogPost->image_path);
        $this->deleteMultipleImages($blogPost->galery);

        $blogPost->delete();

        return response()->json(['message' => 'Blog post deleted successfully']);
    }

    public function webIndex()
    {
        $news = BlogPost::with(['categories', 'user'])->latest()->paginate(10);
        return view('blogs', compact('news'));
    }

    public function webShow($slug)
    {
        $locale = app()->getLocale();
        $blogPost = BlogPost::with(['categories', 'user'])
            ->whereJsonContains("slug->{$locale}", $slug)
            ->firstOrFail();
        
        // Get approved comments for this blog post
        $comments = $blogPost->comments()
            ->with('user')
            ->where('aproved_status', true)
            ->latest()
            ->get();
        
        // Get related posts (same category, excluding current post)
        $relatedPosts = BlogPost::with(['categories', 'user'])
            ->where('categories_id', $blogPost->categories_id)
            ->where('id', '!=', $blogPost->id)
            ->latest()
            ->limit(4)
            ->get();
        
        // Get recent posts for sidebar
        $newPosts = BlogPost::with(['categories', 'user'])
            ->where('id', '!=', $blogPost->id)
            ->latest()
            ->limit(3)
            ->get();
        
        // Get all categories with blog post counts
        $categories = \App\Models\Categories::withCount('blogPosts')->get();
        
        return view('blog-post', compact('blogPost', 'comments', 'relatedPosts', 'newPosts', 'categories'));
    }
}
