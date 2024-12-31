<?php

namespace Modules\Campaigns\App\Http\Controllers\Api\Auth;

use Illuminate\Support\Facades\Storage;
use Modules\Campaigns\App\Models\Campaign;
use Modules\Campaigns\App\Policies\CampaignApiPolicy;
use Modules\Campaigns\App\Resources\CampaignResource;

class UserCampaigns extends \Lynx\Base\Api
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
     * @var string
     */
    protected $policy               = CampaignApiPolicy::class;
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
    protected $FullJsonInStore      = false;
     /**
     * @var bool
     */
    protected $FullJsonInUpdate     = false;
     /**
     * @var bool
     */
    protected $FullJsonInDestroy    = false;
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

        return $entity->where('user_id', auth('api')->id())->orderBy('created_at', 'desc');
    }

     /**
     * Append data when storing or updating.
     *
     * @return array<string, mixed>
     */
    public function append(): array
    {

        $data = [
            'user_id' => auth('api')->id(),
        ];
        $file = lynx()->uploadFile('image', 'campaign/image');
        if (!empty($file)) {
            $data['image'] = $file;
        }
        return $data;
    }

    /**
     * Validation rules for store and update.
     *
     * @param string $type
     * @param int|null $id
     * @return array<string, string>
     */
    public function rules(string $type, mixed $id = null): array
    {
        return $type == 'store' ? [

            'name:en'       => 'required|string|max:255',
            'content:en'    => 'required|string',

            'name:ar'       => 'required|string|max:255',
            'content:ar'    => 'required|string',

            'image'          => 'required|image|mimetypes:image/*|max:2048',
            'video_url'      => 'required|active_url',
            'start_at'       => 'required|date|date_format:Y-m-d H:i:s|before_or_equal:' . now()->format('Y-m-d H:i:s'),
            'end_at'         => 'required|date|date_format:Y-m-d H:i:s|after_or_equal:start_at',
            'total_days'     => 'required|integer|min:1',
            'is_public'      => 'required|in:yes,no',
            'currency_id'    => 'required|exists:countries,id',
            'sort'           => 'required|integer',
            'status'         => 'required|in:pending, published, ended,completed,cancelled',
            'price_target'   => 'required|numeric',
            'category_id'    => 'required|exists:categories,id',



        ] : [

            'name:en'       => 'required|string|max:255',
            'content:en'    => 'required|string',

            'name:ar'       => 'required|string|max:255',
            'content:ar'    => 'required|string',

            'image'          => 'required|image|mimetypes:image/*|max:2048',
            'video_url'      => 'required|active_url',
            'start_at'       => 'required|date|date_format:Y-m-d H:i:s|before:end_at',
            'end_at'         => 'required|date|date_format:Y-m-d H:i:s|after:start_at',
            'total_days'     => 'required|integer|min:1',
            'is_public'      => 'required|in:yes,no',
            'currency_id'    => 'required|exists:countries,id',
            'sort'           => 'required|integer',
            'status'         => 'required|in:pending, published, ended,completed,cancelled',
            'price_target'   => 'required|numeric',
            'category_id'    => 'required|exists:categories,id',

        ];
    }

    /**
     * Custom attribute names for validation rules.
     *
     * @return array<string, string>
     */
    public function niceName()
    {
        return [
            'name:en'           => __('campaigns::main.name'),
            'name:ar'           => __('campaigns::main.name'),
            'content:en'        => __('campaigns::main.content'),
            'content:ar'        => __('campaigns::main.content'),

            'image'             => __('campaigns::main.image'),
            'video_url'         => __('campaigns::main.video_url'),
            'start_at'          => __('campaigns::main.start_at'),
            'end_at'            => __('campaigns::main.end_at'),
            'total_days'        => __('campaigns::main.total_days'),
            'is_public'         => __('campaigns::main.is_public'),
            'currency_id'       => __('campaigns::main.currency_id'),
            'sort'              => __('campaigns::main.sort'),
            'status'            => __('campaigns::main.status'),
            'price_target'      => __('campaigns::main.price_target'),
            'category_id'      => __('campaigns::main.category'),
        ];
    }

    /**
     * Modify data before storing.
     *
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     */
    public function beforeStore(array $data): array
    {

        // $data['title'] = 'replace data';
        return $data;
    }

   /**
     * Actions after storing.
     *
     * @param Campaign $entity
     * @return void
     */
    public function afterStore($entity): void
    {
        // dd($entity->id);
    }

    /**
     * Modify data before updating.
     *
     * @param Campaign $entity
     * @return void
     */
    public function beforeUpdate($entity): void {}

    /**
     * Actions after updating.
     *
     * @param Campaign $entity
     * @return void
     */
    public function afterUpdate($entity): void
    {
        $translations = [
            'name:en' => request('name:en'),
            'name:ar' => request('name:ar'),
            'content:en' => request('content:en'),
            'content:ar' => request('content:ar'),
        ];

        $entity->update($translations);


        if (request()->hasFile('image')) {
            if (!empty($entity->image)) {
                Storage::delete($entity->image);
            }
    
            $file = lynx()->uploadFile('image', 'campaign/image');
            if (!empty($file)) {
                $entity->update(['image' => $file]);
            }
        }
    }

    /**
     * Modify data before showing.
     *
     * @param Campaign $entity
     * @return Campaign
     */
    public function beforeShow($entity): Object
    {
        return $entity;
    }

    /**
     * Actions after showing.
     *
     * @param Campaign $entity
     * @return CampaignResource
     */
    public function afterShow($entity): Object
    {
        return new CampaignResource($entity);
    }

    /**
     * Actions before deleting a record.
     *
     * @param Campaign $entity
     * @return void
     */
    public function beforeDestroy($entity): void
    {
        // if (!empty($entity->image)) {
        //     Storage::delete($entity->image);
        // }
    }

   /**
     * Actions after deleting a record.
     *
     * @param Campaign $entity
     * @return void
     */
    public function afterDestroy($entity): void
    {
        // do something
        // $entity->file
    }
}
