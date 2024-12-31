<?php

namespace Modules\Categories\App\Policies;

use Dash\Policies\Policy;

class CategoryPolicy extends Policy
{

    /**
     * Resource Policy Name
     * @var string $resource
     */
    protected $resource = 'Categories';
}
