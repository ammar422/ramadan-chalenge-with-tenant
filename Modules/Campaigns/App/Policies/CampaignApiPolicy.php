<?php

namespace Modules\Campaigns\App\Policies;

use Modules\Users\App\Models\User;
use Modules\Campaigns\App\Models\Campaign;
use Illuminate\Auth\Access\HandlesAuthorization;

class CampaignApiPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Campaign $campaign): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Campaign $campaign): bool
    {
        return true;
    }

    public function delete(User $user, Campaign $campaign): bool
    {
        return true;
    }
}
