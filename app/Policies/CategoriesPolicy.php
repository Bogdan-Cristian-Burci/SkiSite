<?php

namespace App\Policies;

use App\Models\Categories;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoriesPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // Allow admins and instructors to view categories in dashboard
        return $user->hasRole(['admin', 'instructor']);
    }

    public function view(User $user, Categories $categories)
    {
        // Allow admins and instructors to view categories
        return $user->hasRole(['admin', 'instructor']);
    }

    public function create(User $user)
    {
        // Allow admins and instructors to create categories
        return $user->hasRole(['admin', 'instructor']);
    }

    public function update(User $user, Categories $categories)
    {
        // Allow admins to update any category
        // Allow instructors to update categories (since they're shared resources)
        return $user->hasRole(['admin', 'instructor']);
    }

    public function delete(User $user, Categories $categories)
    {
        // Only admins can delete categories
        // Check if category has blog posts - prevent deletion if it does
        return $user->hasRole('admin') && $categories->blogPosts()->count() === 0;
    }

    public function restore(User $user, Categories $categories)
    {
        // Only admins can restore deleted categories
        return $user->hasRole('admin');
    }

    public function forceDelete(User $user, Categories $categories)
    {
        // Only admins can permanently delete categories
        // And only if they have no blog posts
        return $user->hasRole('admin') && $categories->blogPosts()->count() === 0;
    }
}
