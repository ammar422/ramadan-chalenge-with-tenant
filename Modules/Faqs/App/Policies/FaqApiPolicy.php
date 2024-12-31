<?php

namespace Modules\Faqs\App\Policies;

use Modules\Faqs\App\Models\Faq;
use Modules\Users\App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FaqApiPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Faq $Faq): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Faq $Faq): bool
    {
        return  false;
    }

    public function delete(User $user, Faq $Faq): bool
    {
        return false;
    }
}
