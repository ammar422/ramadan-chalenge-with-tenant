<?php

namespace Modules\Campaigns\App\Policies;

use Modules\Users\App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Campaigns\App\Models\Donation;

class DonationApiPolicy
{
    use HandlesAuthorization;

    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Donation $donation): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Donation $donation): bool
    {
        return false;
    }

    public function delete(User $user, Donation $donation): bool
    {
        return false;
    }
}
