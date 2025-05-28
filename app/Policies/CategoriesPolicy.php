<?php

namespace App\Policies;

use App\Models\Categories;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoriesPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }

    public function view(User $user, Categories $categories)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, Categories $categories)
    {
    }

    public function delete(User $user, Categories $categories)
    {
    }

    public function restore(User $user, Categories $categories)
    {
    }

    public function forceDelete(User $user, Categories $categories)
    {
    }
}
