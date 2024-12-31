<?php

namespace Modules\Pages\App\Http\Controllers\Api;

use Modules\Pages\App\Models\Page;
use Modules\Pages\App\Resources\PageResource;

class PageController extends \Lynx\Base\Api
{
    /**
     * @var string
     */
    protected $entity               = Page::class;
    /**
     * @var string
     */
    protected $resourcesJson        = PageResource::class;
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
     * @param Page $entity
     * @return Object
     */
    public function query($entity): Object
    {
        return $entity->where(function ($query) {
            !empty(request('name')) ? $query->whereTranslationLike('name',  '%' . request('name') . '%') : null;
        })->where('status', 'show');
    }


    /**
     * @param Page $entity
     *
     * @return object
     */
    public function beforeShow($entity): object
    {
        $entity = $entity->where('status', 'show');
        return $entity;
    }


    /**
     * this method use or append data when Show data
     * @param Page $entity
     * @return object
     */
    public function afterShow($entity): Object
    {
        return new PageResource($entity);
    }
}
