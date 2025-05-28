<?php

namespace App\Policies;

use App\Models\Camp;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CampPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function view(User $user, Camp $camp): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function update(User $user, Camp $camp): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function delete(User $user, Camp $camp): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function restore(User $user, Camp $camp): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function forceDelete(User $user, Camp $camp): bool
    {
        return $user->hasPermissionTo('manage content');
    }
}
