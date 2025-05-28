<?php

namespace App\Policies;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPostPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // Allow admins and instructors to view blog posts in dashboard
        return $user->hasRole(['admin', 'instructor']);
    }

    public function view(User $user, BlogPost $blogPost)
    {
        // Allow admins and instructors to view blog posts
        // Or allow users to view their own blog posts
        return $user->hasRole(['admin', 'instructor']) || $user->id === $blogPost->user_id;
    }

    public function create(User $user)
    {
        // Allow admins and instructors to create blog posts
        return $user->hasRole(['admin', 'instructor']);
    }

    public function update(User $user, BlogPost $blogPost)
    {
        // Allow admins to update any blog post
        // Allow instructors to update their own blog posts
        return $user->hasRole('admin') || 
               ($user->hasRole('instructor') && $user->id === $blogPost->user_id);
    }

    public function delete(User $user, BlogPost $blogPost)
    {
        // Allow admins to delete any blog post
        // Allow instructors to delete their own blog posts
        return $user->hasRole('admin') || 
               ($user->hasRole('instructor') && $user->id === $blogPost->user_id);
    }

    public function restore(User $user, BlogPost $blogPost)
    {
        // Only admins can restore deleted blog posts
        return $user->hasRole('admin');
    }

    public function forceDelete(User $user, BlogPost $blogPost)
    {
        // Only admins can permanently delete blog posts
        return $user->hasRole('admin');
    }
}
