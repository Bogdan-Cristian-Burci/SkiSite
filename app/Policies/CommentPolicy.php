<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Comment $comment): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Comment $comment): bool
    {
        return true;
    }

    public function delete(User $user, Comment $comment): bool
    {
        return true;
    }

    public function restore(User $user, Comment $comment): bool
    {
        return true;
    }

    public function forceDelete(User $user, Comment $comment): bool
    {
        return false;
    }
}
