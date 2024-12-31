<?php

namespace Modules\Countries\App\Policies;

use Modules\Users\App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Countries\App\Models\Country;

class CountryApiPolicy
{

    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Country $Country): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Country $Country): bool
    {
        return  false;
    }

    public function delete(User $user, Country $Country): bool
    {
        return false;
    }
}
