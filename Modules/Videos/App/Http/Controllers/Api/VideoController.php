<?php

namespace Modules\Videos\App\Http\Controllers\Api;

use Modules\Videos\App\Models\Video;
use Modules\Videos\App\Resources\VideoResource;

class VideoController extends \Lynx\Base\Api
{
    /**
     * @var string
     */
    protected $entity               = Video::class;
    /**
     * @var string
     */
    protected $resourcesJson        = VideoResource::class;
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
     *
     * @param Video $entity
     * 
     * @return Object
     */
    public function query($entity): Object
    {
        return $entity->where(function ($query) {
            !empty(request('title')) ? $query->whereTranslationLike('title', '%' . request('title') . '%') : null;
        });
    }


    /**
     * this method use or append data when Show data
     * @param Video $entity
     * @return object
     */
    public function beforeShow($entity): Object
    {
        return new $this->resourcesJson($entity);
    }


     /**
     * this method use or append data when Show data
     * @param Video $entity
     * @return object
     */
    public function afterShow($entity): Object
    {
        return new VideoResource($entity);
    }
}
