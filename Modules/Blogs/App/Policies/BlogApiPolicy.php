<?php

namespace Modules\Blogs\App\Policies;

use Modules\Blogs\App\Models\Blog;
use Modules\Users\App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogApiPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Blog $Blog): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Blog $Blog): bool
    {
        return false;
    }

    public function delete(User $user, Blog $Blog): bool
    {
        return false;
    }
}
