<?php

namespace Modules\Campaigns\App\Dash\Resources;

use Dash\Resource;
use Modules\Campaigns\App\Models\Campaign;
use Modules\Users\App\Dash\Resources\Users;
use Modules\Campaigns\App\Policies\CampaignPolicy;
use Modules\Campaigns\App\Dash\Resources\Donations;
use Modules\Countries\App\Dash\Resources\Currencies;
use Modules\Categories\App\Dash\Resources\Categories;
use Modules\Campaigns\App\Dash\Metrics\Values\AllCampaigns;
use Modules\Campaigns\App\Dash\Metrics\Averages\AverageCampaignsAmount;
use Modules\Campaigns\App\Dash\Metrics\Progress\Campaigns\EndedCampaigns;
use Modules\Campaigns\App\Dash\Metrics\Progress\Campaigns\PendingCampaigns;
use Modules\Campaigns\App\Dash\Metrics\Progress\Campaigns\CancelledCampaigns;
use Modules\Campaigns\App\Dash\Metrics\Progress\Campaigns\CompletedCampaigns;
use Modules\Campaigns\App\Dash\Metrics\Progress\Campaigns\PublishedCampaigns;

class Campaigns extends Resource
{

    /**
     * define Model of resource
     * @var string $model
     */
    public static $model = Campaign::class;


    /**
     * Policy Permission can handel
     * (viewAny,view,create,update,delete,forceDelete,restore) methods
     * @var string $policy
     */

    public static $policy = CampaignPolicy::class;


    /**
     * define this resource in group to show in navigation menu
     * if you need to translate a dynamic name
     * define dash.php in /resources/views/lang/en/dash.php
     * and add this key directly users
     * @var string $group
     */
    public static $group = 'Campaigns';



    /**
     * show or hide resouce In Navigation Menu true|false
     * @var bool $displayInMenu
     */
    public static $displayInMenu = true;

    /**
     * change icon in navigation menu
     * you can use font awesome icons LIKE (<i class="fa fa-users"></i>)
     * @var string $icon
     */
    public static $icon = '<i class="fa-solid fa-hand-holding-dollar"></i>'; // put <i> tag or icon name

    /**
     * title static property to labels in Rows,Show,Forms
     * @var string $title
     */
    public static $title = 'name';

    /**
     * defining column name to enable or disable search in main resource page
     * @var array<string> $search
     */
    public static $search = [
        'image',
        'video_url',
        'start_at',
        'end_at',
        'total_days',
        'total_donors',
        'total_amount',
        'is_public',
        'currency_id',
        'user_id',
        'sort',
        'status',
        'price_target',
        'category_id',
    ];

    /**
     *  if you want define relationship searches
     *  one or Multiple Relations
     * 	Example: method=> 'invoices'  => columns=>['title'],
     * @var array<string, mixed> $searchWithRelation
     */
    public static $searchWithRelation = [
        'translation' => ['name', 'content'],
    ];

    /**
     * if you need to custom resource name in menu navigation
     * @return string
     */
    public static function customName()
    {
        return __('dash.Campaigns');
    }

    /**
     * you can define vertext in header of page like (Card,HTML,view blade)
     * @return array<string>
     */
    public static function vertex()
    {
        return [
            (new AllCampaigns)->render(),
            (new PublishedCampaigns)->render(),
            (new CancelledCampaigns)->render(),
            (new EndedCampaigns)->render(),
            (new PendingCampaigns)->render(),
            (new CompletedCampaigns)->render(),
            (new AverageCampaignsAmount)->render(),
        ];
    }

    /**
     * define fields by Helpers
     * @return array<string>
     */
    public function fields()
    {
        return [
            text(__('campaigns::main.name'), 'name')
                ->translatable(config('dash.DASHBOARD_LANGUAGES'))
                ->rule('required', 'string'),

            ckeditor(__('campaigns::main.content'), 'content')
                ->translatable(config('dash.DASHBOARD_LANGUAGES'))
                ->rule('required', 'string')
                ->hideInIndex(),

            checkbox()
                ->make(__('campaigns::main.is_public'), 'is_public')
                ->default('no')
                ->trueVal('yes')
                ->falseVal('no'),

            fullDateTime(__('campaigns::main.start_at'), 'start_at')
                ->column(6)
                ->rule('required', 'before:end_at')
                ->inline(false)
                ->altInput(false)
                ->format('Y-m-d h:i:s')
                ->enableTime(true)
                ->time_24hr(false)
                ->minDate('today')
                ->maxDate(30)
                ->f(),

            fullDateTime(__('campaigns::main.end_at'), 'end_at')
                ->column(6)
                ->rule('required', 'after:start_at')
                ->inline(false)
                ->altInput(false)
                ->format('Y-m-d h:i:s')
                ->enableTime(true)
                ->time_24hr(false)
                ->maxDate(30)
                ->f(),

            text(__('campaigns::main.video_url'), 'video_url')
                ->rule('sometimes', 'nullable', 'url')
                ->column(4)
                ->hideInIndex(),

            number(__('campaigns::main.price_target'), 'price_target')
                ->rule('required')
                ->column(4),

            image(__('campaigns::main.image'), 'image')
                ->path('Campaigns/{id}')
                ->column(4)
                ->rule('required', 'image')
                ->acceptedMimeTypes('image/*')
                ->hideInIndex()
                ->disableDownloadButton(),

            number(__('campaigns::main.total_days'), 'total_days')
                ->rule('required', 'numeric')
                ->column(4),

            number(__('campaigns::main.remaining_days'), 'remaining_days')
                ->onlyShow()
                ->column(4),

            number(__('campaigns::main.total_donors'), 'total_donors')
                ->column(4)
                ->showInIndex()
                ->onlyShow(),

            number(__('campaigns::main.total_amount'), 'total_amount')
                ->column(4)
                ->showInIndex()
                ->onlyShow(),

            number(__('campaigns::main.sort '), 'sort')
                ->column(4)
                ->rule('required', 'numeric'),

            select(__('campaigns::main.status'), 'status')
                ->options([
                    'pending'           => __('campaigns::main.pending'),
                    'published'         => __('campaigns::main.published'),
                    'ended'             => __('campaigns::main.ended'),
                    'cmpleted'          => __('campaigns::main.completed'),
                    'cancelled'         => __('campaigns::main.cancelled'),
                ])
                ->column(4)
                ->f()
                ->rule('required', 'in:pending,published,ended,completed,cancelled'),

            belongsTo(__('campaigns::main.currency_id'), 'currency', Currencies::class)
                ->column(4)
                ->f()
                ->inlineButton()
                ->rule('required'),

            belongsTo(__('campaigns::main.user_id'), 'user', Users::class)
                ->column(4)
                ->f()
                ->inlineButton()
                ->rule('required'),

            belongsTo(__('campaigns::main.category'), 'category', Categories::class)
                ->rule('required')
                ->inlineButton()
                ->column(4)
                ->f(),

            hasMany(__('campaigns::main.donations'), 'donations', Donations::class)
                ->use('campaign')->hideInIndex()
        ];
    }

    /**
     * define the actions To Using in Resource (index,show)
     * php artisan dash:make-action ActionName
     * @return array<string>
     */
    public function actions()
    {
        return [];
    }

    /**
     * define the filters To Using in Resource (index)
     * php artisan dash:make-filter FilterName
     * @return array<string>
     */
    public function filters()
    {
        return [];
    }
}
