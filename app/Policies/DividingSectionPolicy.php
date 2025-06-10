<?php

namespace App\Policies;

use App\Models\DividingSection;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DividingSectionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasRole('admin');
    }

    public function view(User $user, DividingSection $dividingSection)
    {
        return $user->hasRole('admin');
    }

    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, DividingSection $dividingSection)
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user, DividingSection $dividingSection)
    {
        return $user->hasRole('admin');
    }

    public function restore(User $user, DividingSection $dividingSection)
    {
        return $user->hasRole('admin');
    }

    public function forceDelete(User $user, DividingSection $dividingSection)
    {
        return $user->hasRole('admin');
    }
}