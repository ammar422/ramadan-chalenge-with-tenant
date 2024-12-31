<?php

namespace Modules\Campaigns\App\Policies;

use Dash\Policies\Policy;

class CampaignPolicy extends Policy
{

	/**
	 * Resource Policy Name
	 * @var string $resource
	 */
	protected $resource = 'Campaigns';

}
