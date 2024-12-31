<?php

namespace Modules\Campaigns\App\Policies;

use Dash\Policies\Policy;

class DonationPolicy extends Policy
{

    /**
     * Resource Policy Name
     * @var string $resource
     */
    protected $resource = 'Donations';
}
