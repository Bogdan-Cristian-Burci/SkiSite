<?php

namespace App\Policies;

use App\Models\SkiProgram;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SkiProgramPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasRole('admin');
    }

    public function view(User $user, SkiProgram $skiProgram)
    {
        return $user->hasRole('admin');
    }

    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, SkiProgram $skiProgram)
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user, SkiProgram $skiProgram)
    {
        return $user->hasRole('admin');
    }

    public function restore(User $user, SkiProgram $skiProgram)
    {
        return $user->hasRole('admin');
    }

    public function forceDelete(User $user, SkiProgram $skiProgram)
    {
        return $user->hasRole('admin');
    }
}
