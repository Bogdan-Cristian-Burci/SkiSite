<?php

namespace App\Policies;

use App\Models\Regulation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegulationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function view(User $user, Regulation $regulation): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function update(User $user, Regulation $regulation): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function delete(User $user, Regulation $regulation): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function restore(User $user, Regulation $regulation): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function forceDelete(User $user, Regulation $regulation): bool
    {
        return $user->hasPermissionTo('manage content');
    }
}
