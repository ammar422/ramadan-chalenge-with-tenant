<?php

namespace Modules\Blogs\App\Policies;

use Dash\Policies\Policy;

class BlogPolicy extends Policy
{
    /**
     * Resource Policy Name
     * @var string $resource
     */
    protected $resource = 'Blogs';
}
