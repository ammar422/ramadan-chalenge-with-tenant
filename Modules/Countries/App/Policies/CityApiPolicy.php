<?php

namespace Modules\Countries\App\Policies;

use Modules\Users\App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Countries\App\Models\City;

class CityApiPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, City $City): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, City $City): bool
    {
        return  false;
    }

    public function delete(User $user, City $City): bool
    {
        return false;
    }
}
