<?php

namespace Modules\WebLinks\App\Http\Controllers\Api;

use Modules\WebLinks\App\Models\Weblink;
use Modules\WebLinks\App\resources\WebLinkResource;

class WeblinkController extends \Lynx\Base\Api
{
    /**
     * @var string
     */
    protected $entity               = Weblink::class;
    /**
     * @var string
     */
    protected $resourcesJson        = WebLinkResource::class;
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
     * @param Weblink $entity
     * 
     * @return Object
     */
    public function query($entity): Object
    {
        abort_if(!in_array(request('place'), ['header', 'footer']), 403, 'plcae must in header or footer');
        return $entity->where('status', 'show')->where('place', request('place', 'header'));
    }


    /**
     * @param Weblink $entity
     * 
     * @return Object
     */
    public function afterShow($entity): Object
    {
        return new  $this->resourcesJson($entity);
    }
}
