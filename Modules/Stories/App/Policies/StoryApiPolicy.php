<?php

namespace Modules\Stories\App\Policies;

use Modules\Users\App\Models\User;
use Modules\Stories\App\Models\Story;
use Illuminate\Auth\Access\HandlesAuthorization;

class StoryApiPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * 
     * @return bool
     */
    public function viewAny(User $user)
    {
        return  true;
    }

    /**
     * @param User $user
     * @param Story $Story
     * 
     * @return bool
     */
    public function view(User $user, Story $Story)
    {
        return  true;
    }

    /**
     * @param User $user
     * 
     * @return bool
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * @param User $user
     * @param Story $Story
     * 
     * @return bool
     */
    public function update(User $user, Story $Story)
    {
        return  false;
    }

    /**
     * @param User $user
     * @param Story $Story
     * 
     * @return bool
     */
    public function delete(User $user, Story $Story)
    {
        return false;
    }
}
