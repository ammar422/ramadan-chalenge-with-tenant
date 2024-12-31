<?php

namespace Modules\Countries\App\Http\Controllers\Api;

use Modules\Countries\App\Models\City;
use Modules\Countries\App\Resources\CityResource;

class CityController extends \Lynx\Base\Api
{
    /**
     * @var string
     */
    protected $entity               = City::class;
     /**
     * @var string
     */
    protected $resourcesJson        = CityResource::class;
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
     * @param City $entity
     * @return Object
     */
    public function query($entity): Object
    {
        abort_if(empty(request('country_id')), 400, 'need country id');
        return $entity->where(function ($query) {
            //name
            if (!empty(request('name'))) {
                $query->whereTranslationLike('name', '%' . request('name') . '%');
            }
        })->where('country_id', request('country_id'));
    }

    /**
     * this method use or append data when Show data
     * @param City $entity
     * @return object
     */
    public function afterShow($entity): Object
    {
        return new $this->resourcesJson($entity);
    }
}
