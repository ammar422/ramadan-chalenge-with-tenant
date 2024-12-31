<?php

namespace Modules\Partners\App\Policies;

use Modules\Users\App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Partners\App\Models\Partner;

class PartnerApiPolicy
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
     * @param Partner $Partner
     * 
     * @return bool
     */
    public function view(User $user, Partner $Partner)
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
     * @param Partner $Partner
     * 
     * @return bool
     */
    public function update(User $user, Partner $Partner)
    {
        return  false;
    }

    /**
     * @param User $user
     * @param Partner $Partner
     * 
     * @return bool
     */
    public function delete(User $user, Partner $Partner)
    {
        return false;
    }
}
