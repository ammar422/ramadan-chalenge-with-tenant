<?php

namespace Modules\Faqs\App\Http\Controllers\Api;

use Modules\Faqs\App\Models\Faq;
use Modules\Faqs\App\Resources\FaqResource;

class FaqController extends \Lynx\Base\Api
{
    /**
     * @var string
     */
    protected $entity               = Faq::class;
    /**
     * @var string
     */
    protected $resourcesJson        = FaqResource::class;
     /**
     * @var bool
     */
    protected $spatieQueryBuilder   = true;
     /**
     * @var bool
     */
    protected $paginateIndex        = false;
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
      * @param Faq $entity
     * @return Object
     */
    public function query($entity): Object
    {
        return $entity->where(function ($query) {
            //title
            if (!empty(request('title'))) {
                $query->whereTranslationLike('title', '%' . request('title') . '%');
            }
        });
    }

    /**
     * @param Faq $entity
     * 
     * @return Object
     */
    public function beforeShow($entity): Object
    {
        return $entity;
    }

     /**
     * this method use or append data when Show data
     * @param Faq $entity
     * @return object
     */
    public function afterShow($entity): Object
    {
        return new FaqResource($entity);
    }

 
}
