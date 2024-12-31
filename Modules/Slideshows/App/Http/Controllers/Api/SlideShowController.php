<?php

namespace Modules\SlideShows\App\Http\Controllers\Api;

use Modules\SlideShows\App\Models\SlideShow;
use Modules\SlideShows\App\Resources\SlideShowResource;

class SlideShowController extends \Lynx\Base\Api
{
    /**
     * @var string
     */
    protected $entity               = SlideShow::class;
    /**
     * @var string
     */
    protected $resourcesJson        = SlideShowResource::class;
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
     * @param SlideShow $entity
     * 
     * @return Object
     */
    public function query($entity): Object
    {
        return $entity->where(function ($query) {
            !empty(request('title'))        ? $query->whereTranslationLike('title', '%' . request('title') . '%') : null;
            !empty(request('url_title'))    ? $query->whereTranslationLike('url_title', '%' . request('url_title') . '%') : null;
            !empty(request('content'))      ? $query->whereTranslationLike('content', '%' . request('content') . '%') : null;
        })->where('status', 'show');
    }


    /**
     * @param SlideShow $entity
     * 
     * @return Object
     */
    public function afterShow($entity): Object
    {
        return new SlideShowResource($entity);
    }
}
