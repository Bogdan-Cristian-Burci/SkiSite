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

    }

    public function view(User $user, Testimonial $testimonial)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, Testimonial $testimonial)
    {
    }

    public function delete(User $user, Testimonial $testimonial)
    {
    }

    public function restore(User $user, Testimonial $testimonial)
    {
    }

    public function forceDelete(User $user, Testimonial $testimonial)
    {
    }
}
