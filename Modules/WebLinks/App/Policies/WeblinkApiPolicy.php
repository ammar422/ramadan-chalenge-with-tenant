<?php

namespace Modules\WebLinks\App\Policies;

use Modules\Users\App\Models\User;
use Modules\WebLinks\App\Models\Weblink;
use Illuminate\Auth\Access\HandlesAuthorization;

class WeblinkApiPolicy
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
     * @param Weblink $Weblink
     * 
     * @return bool
     */
    public function view(User $user, Weblink $Weblink)
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
     * @param Weblink $Weblink
     * 
     * @return bool
     */
    public function update(User $user, Weblink $Weblink)
    {
        return  false;
    }

    /**
     * @param User $user
     * @param Weblink $Weblink
     * 
     * @return bool
     */
    public function delete(User $user, Weblink $Weblink)
    {
        return false;
    }
}
