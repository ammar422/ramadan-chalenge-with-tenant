<?php

namespace Modules\Countries\App\Http\Controllers\Api;

use Modules\Countries\App\Models\Country;
use Modules\Countries\App\Resources\CountryResource;

class CountryController extends \Lynx\Base\Api
{
     /**
     * @var string
     */
    protected $entity               = Country::class;
    /**
     * @var string
     */
    protected $resourcesJson        = CountryResource::class;
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
     * @param Country $entity
     * @return Object
     */
    public function query($entity): Object
    {
        return $entity->where(function ($query) {
            if (!empty(request('name'))) {
                $query->whereTranslationLike('name', '%' . request('name') . '%');
            }
        });
    }

     /**
     * this method use or append data when Show data
     * @param Country $entity
     * @return object
     */
    public function afterShow($entity): Object
    {
        return new CountryResource($entity);
    }
}
