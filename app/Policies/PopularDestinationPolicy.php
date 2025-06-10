<?php

namespace App\Policies;

use App\Models\PopularDestination;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PopularDestinationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasRole('admin');
    }

    public function view(User $user, PopularDestination $popularDestination)
    {
        return $user->hasRole('admin');
    }

    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, PopularDestination $popularDestination)
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user, PopularDestination $popularDestination)
    {
        return $user->hasRole('admin');
    }

    public function restore(User $user, PopularDestination $popularDestination)
    {
        return $user->hasRole('admin');
    }

    public function forceDelete(User $user, PopularDestination $popularDestination)
    {
        return $user->hasRole('admin');
    }
}