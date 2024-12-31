<?php
namespace Modules\Countries\App\Policies;
use Dash\Policies\Policy;

class CountryPolicy extends Policy {

    /**
	 * Resource Policy Name
	 * @var string $resource
	 */
	protected $resource = 'Countries';

}
