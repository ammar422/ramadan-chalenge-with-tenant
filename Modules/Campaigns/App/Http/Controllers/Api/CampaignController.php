<?php

namespace Modules\Campaigns\App\Http\Controllers\Api;

use Modules\Campaigns\App\Models\Campaign;
use Modules\Campaigns\App\Resources\CampaignResource;
use Modules\Campaigns\App\Resources\ShowCampaignResource;

class CampaignController extends \Lynx\Base\Api
{
    /**
     * @var string
     */
    protected $entity               = Campaign::class;
    /**
     * @var string
     */
    protected $resourcesJson        = CampaignResource::class;
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
    * @param Campaign $entity
     * @return Object
     */
    public function query($entity): Object
    {
        abort_if(!empty(request('is_public')) && !in_array(request('is_public'), ['yes', 'no']), 422, 'when call is public please use yes or no');
        return $entity->where(function ($q) {
            !empty(request('is_public')) ? $q->where('is_public', request('is_public'))->limit(6) : '';
            !empty(request('is_public')) ? $q->orderBy('sort', 'desc') : $q->latest();
        });
    }


   /**
     * Modify data after showing.
     *
     * @param Campaign $entity
     * @return Object
     */
    public function afterShow($entity): Object
    {

        return new ShowCampaignResource($entity);
    }
}
