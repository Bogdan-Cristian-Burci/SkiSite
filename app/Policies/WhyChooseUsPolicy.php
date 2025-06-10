<?php

namespace App\Policies;

use App\Models\WhyChooseUs;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class WhyChooseUsPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasRole('admin');
    }

    public function view(User $user, WhyChooseUs $whyChooseUs)
    {
        return $user->hasRole('admin');
    }

    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, WhyChooseUs $whyChooseUs)
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user, WhyChooseUs $whyChooseUs)
    {
        return $user->hasRole('admin');
    }

    public function restore(User $user, WhyChooseUs $whyChooseUs)
    {
        return $user->hasRole('admin');
    }

    public function forceDelete(User $user, WhyChooseUs $whyChooseUs)
    {
        return $user->hasRole('admin');
    }
}