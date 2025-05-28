<?php

namespace App\Policies;

use App\Models\SkiInstructor;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SkiInstructorPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function view(User $user, SkiInstructor $skiInstructor): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function update(User $user, SkiInstructor $skiInstructor): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function delete(User $user, SkiInstructor $skiInstructor): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function restore(User $user, SkiInstructor $skiInstructor): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function forceDelete(User $user, SkiInstructor $skiInstructor): bool
    {
        return $user->hasPermissionTo('manage content');
    }
}
