<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Webcam;
use Illuminate\Auth\Access\HandlesAuthorization;

class WebcamPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function view(User $user, Webcam $webcam): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function update(User $user, Webcam $webcam): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function delete(User $user, Webcam $webcam): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function restore(User $user, Webcam $webcam): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function forceDelete(User $user, Webcam $webcam): bool
    {
        return $user->hasPermissionTo('manage content');
    }
}
