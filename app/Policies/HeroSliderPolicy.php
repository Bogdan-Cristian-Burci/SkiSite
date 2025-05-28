<?php

namespace App\Policies;

use App\Models\HeroSlider;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HeroSliderPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function view(User $user, HeroSlider $heroSlider): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function update(User $user, HeroSlider $heroSlider): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function delete(User $user, HeroSlider $heroSlider): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function restore(User $user, HeroSlider $heroSlider): bool
    {
        return $user->hasPermissionTo('manage content');
    }

    public function forceDelete(User $user, HeroSlider $heroSlider): bool
    {
        return $user->hasPermissionTo('manage content');
    }
}
