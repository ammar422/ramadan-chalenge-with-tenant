<?php

namespace Modules\Stories\App\Http\Controllers\Api;

use Modules\Stories\App\Models\Story;
use Modules\Stories\App\Resources\StoryResource;

class StoryController extends \Lynx\Base\Api
{
    /**
     * @var string
     */
    protected $entity               = Story::class;
    /**
     * @var string
     */
    protected $resourcesJson        = StoryResource::class;
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
     * @param Story $entity 
     * @return object
     */
    public function query($entity): Object
    {
        return $entity->where(function ($query) {

            if (!empty(request('name'))) {
                $query->whereTranslationLike('title',  '%' . request('title') . '%');
            }
        });
    }

    /**
     * this method use or append data when Show data
     * @param Story $entity 
     * @return object
     */
    public function beforeShow($entity): Object
    {
        return $entity;
    }

    /**
     * this method use or append data when Show data
     * @param Story $entity 
     * @return object
     */
    public function afterShow($entity): Object
    {
        return new StoryResource($entity);
    }
}
