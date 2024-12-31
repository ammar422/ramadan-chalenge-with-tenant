<?php

namespace Modules\Stories\App\Policies;

use Dash\Policies\Policy;

class StoryPolicy extends Policy
{

	/**
	 * Resource Policy Name
	 * @var string $resource
	 */
	protected $resource = 'Stories';
}
