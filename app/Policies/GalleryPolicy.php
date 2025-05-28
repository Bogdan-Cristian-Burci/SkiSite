<?php

namespace App\Policies;

use App\Models\Gallery;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GalleryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasRole('admin');
    }

    public function view(User $user, Gallery $gallery)
    {
        return $user->hasRole('admin');
    }

    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, Gallery $gallery)
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user, Gallery $gallery)
    {
        return $user->hasRole('admin');
    }

    public function restore(User $user, Gallery $gallery)
    {
        return $user->hasRole('admin');
    }

    public function forceDelete(User $user, Gallery $gallery)
    {
        return $user->hasRole('admin');
    }
}
