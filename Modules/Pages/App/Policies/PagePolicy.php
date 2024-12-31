<?php
namespace Modules\Pages\App\Policies;
use Dash\Policies\Policy;

class PagePolicy extends Policy {

    /**
	 * Resource Policy Name
	 * @var string $resource
	 */
	protected $resource = 'Pages';

}
