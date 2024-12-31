<?php
namespace Modules\Videos\App\Policies;
use Dash\Policies\Policy;

class VideoPolicy extends Policy {

    /**
	 * Resource Policy Name
	 * @var string $resource
	 */
	protected $resource = 'Videos';

}
