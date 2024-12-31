<?php

namespace Modules\Blogs\App\Http\Controllers\Api;

use Modules\Blogs\App\Models\Blog;
use Modules\Blogs\App\Resources\BlogsApiResource;

class BlogsApiController extends \Lynx\Base\Api
{
    /**
     * @var string
     */
    protected $entity               = Blog::class;
    /**
     * @var string
     */
    protected $resourcesJson        = BlogsApiResource::class;
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
     * @param Blog $entity
     * @return Object
     */
    public function query($entity): Object
    {
        return $entity->where(function ($query) {
            if (!empty(request('title'))) {
                $query->whereTranslationLike('title', '%' . request('title') . '%');
            }
            if (!empty(request('description'))) {
                $query->whereTranslationLike('description', '%' . request('description') . '%');
            }
            if (!empty(request('content'))) {
                $query->whereTranslationLike('content', '%' . request('content') . '%');
            }
        })->where('status', 'show');
    }

    /**
     * this method use or append data when Show data
     * @param Blog $entity
     * @return object
     */
    public function afterShow($entity): Object
    {
        return new BlogsApiResource($entity);
    }
}
