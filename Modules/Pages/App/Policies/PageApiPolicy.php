<?php

namespace Modules\Pages\App\Policies;

use Modules\Users\App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Pages\App\Models\Page;

class PageApiPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     *
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * @param User $user
     * @param Page $Page
     *
     * @return bool
     */
    public function view(User $user, Page $Page): bool
    {
        return true;
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * @param User $user
     * @param Page $Page
     *
     * @return bool
     */
    public function update(User $user, Page $Page): bool
    {
        return  false;
    }

    /**
     * @param User $user
     * @param Page $Page
     *
     * @return bool
     */
    public function delete(User $user, Page $Page): bool
    {
        return false;
    }
}
