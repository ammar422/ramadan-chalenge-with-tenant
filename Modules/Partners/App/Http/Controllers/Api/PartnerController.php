<?php

namespace Modules\Partners\App\Http\Controllers\Api;

use Modules\Partners\App\Models\Partner;
use Modules\Partners\App\Resources\PartnerResource;

class PartnerController extends \Lynx\Base\Api
{
    /**
     * @var string
     */
    protected $entity               = Partner::class;
    /**
     * @var string
     */
    protected $resourcesJson        = PartnerResource::class;
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
     * can handel custom query when retrive data on index,indexGuest
     * @param Partner $entity 
     * @return object
     */
    public function query($entity): Object
    {
        return $entity->where('status', 'show');
    }

    /**
     * can handel custom query when retrive data on index,indexGuest
     * @param Partner $entity 
     * @return object
     */
    public function beforeShow($entity): Object
    {
        return $entity;
    }

    /**
     * can handel custom query when retrive data on index,indexGuest
     * @param Partner $entity 
     * @return object
     */
    public function afterShow($entity): Object
    {
        return new PartnerResource($entity);
    }
}
