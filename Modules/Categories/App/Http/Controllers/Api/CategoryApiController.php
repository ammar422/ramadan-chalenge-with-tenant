<?php

namespace Modules\Categories\App\Http\Controllers\Api;

use Modules\Categories\App\Models\Category;
use Modules\Categories\App\Resources\CategoryResource;

class CategoryApiController extends \Lynx\Base\Api
{
    /**
     * @var string
     */
    protected $entity               = Category::class;
    /**
     * @var string
     */
    protected $resourcesJson        = CategoryResource::class;
     /**
     * @var bool
     */
    protected $spatieQueryBuilder   = true;
    /**
     * @var bool
     */
    protected $paginateIndex        = true;

    /**
     * can handel custom query when retrive data on index,indexGuest
     * @param Category $entity
     * @return Object
     */
    public function query($entity): Object
    {
        return $entity;
    }

    /**
     * this method use or append data when Show data
     * @param Category $entity
     * @return object
     */
    public function afterShow($entity): Object
    {
        return new CategoryResource($entity);
    }
}
