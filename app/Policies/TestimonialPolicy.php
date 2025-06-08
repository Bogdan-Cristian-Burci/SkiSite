<?php

namespace App\Policies;

use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TestimonialPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Testimonial $testimonial)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Testimonial $testimonial)
    {
        return true;
    }

    public function delete(User $user, Testimonial $testimonial)
    {
        return true;
    }

    public function restore(User $user, Testimonial $testimonial)
    {
        return true;
    }

    public function forceDelete(User $user, Testimonial $testimonial)
    {
        return true;
    }
}
