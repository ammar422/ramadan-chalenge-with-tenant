<?php

namespace Modules\Socials\App\Http\Controllers\Api;

use Modules\Socials\App\Models\Social;
use Modules\Socials\App\Resources\SocialResource;

class SocialController extends \Lynx\Base\Api
{
    /**
     * @var string
     */
    protected $entity               = Social::class;
    /**
     * @var string
     */
    protected $resourcesJson        = SocialResource::class;
    /**
     * @var bool
     */
    protected $spatieQueryBuilder   = true;
    /**
     * @var bool
     */
    protected $paginateIndex        = true;
    /**
     * @var bool
     */
    protected $withTrashed          = true;
    /**
     * @var bool
     */
    protected $indexGuest           = true;



    /**
     * @param Social $entity
     * 
     * @return Object
     */
    public function query($entity): Object
    {
        return $entity->where(function ($query) {
            !empty(request('name')) ? $query->where('name', 'LIKE', request('name')) : null;
        });
    }

    /**
     * @param Social $entity
     * 
     * @return object
     */
    public function afterShow($entity): object
    {
        return new $this->resourcesJson($entity);
    }
}
