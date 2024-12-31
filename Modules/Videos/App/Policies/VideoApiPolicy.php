<?php

namespace Modules\Videos\App\Policies;

use Modules\Users\App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Videos\App\Models\Video;

class VideoApiPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * 
     * @return bool
     */
    public function viewAny(User $user)
    {
        return  true ;
    }

    /**
     * @param User $user
     * @param Video $Video
     * 
     * @return bool
     */
    public function view(User $user, Video $Video)
    {
        return  true ;
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
     * @param Video $Video
     * 
     * @return bool
     */
    public function update(User $user, Video $Video)
    {
        return false;
    }

    /**
     * @param User $user
     * @param Video $Video
     * 
     * @return bool
     */
    public function delete(User $user, Video $Video)
    {
        return false;
    }
}
