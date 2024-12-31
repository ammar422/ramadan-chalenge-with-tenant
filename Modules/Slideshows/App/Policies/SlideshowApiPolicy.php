<?php

namespace Modules\SlideShows\App\Policies;

use Modules\Users\App\Models\User;
use Modules\SlideShows\App\Models\SlideShow;
use Illuminate\Auth\Access\HandlesAuthorization;

class SlideshowApiPolicy
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
     * @param SlideShow $SlideShow
     * 
     * @return bool
     */
    public function view(User $user, SlideShow $SlideShow)
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
     * @param SlideShow $SlideShow
     * 
     * @return bool
     */
    public function update(User $user, SlideShow $SlideShow)
    {
        return  false;
    }

    /**
     * @param User $user
     * @param SlideShow $SlideShow
     * 
     * @return bool
     */
    public function delete(User $user, SlideShow $SlideShow)
    {
        return false;
    }
}
