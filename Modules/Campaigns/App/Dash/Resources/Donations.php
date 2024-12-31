<?php

namespace Modules\Campaigns\App\Dash\Resources;

use Dash\Resource;
use Modules\Campaigns\App\Models\Donation;
use Modules\Campaigns\App\Policies\DonationPolicy;
use Modules\Campaigns\App\Dash\Resources\Campaigns;
use Modules\Countries\App\Dash\Resources\Currencies;
use Modules\Campaigns\App\Dash\Metrics\Values\AllDonations;
use Modules\Campaigns\App\Dash\Metrics\Progress\Donations\DoneDonations;
use Modules\Campaigns\App\Dash\Metrics\Progress\Donations\PendingDonations;
use Modules\Campaigns\App\Dash\Metrics\Progress\Donations\RejectedDonations;

class Donations extends Resource
{

    /**
     * define Model of resource
     * @var string $model
     */
    public static $model = Donation::class;
    /**
     * Policy Permission can handel
     * (viewAny,view,create,update,delete,forceDelete,restore) methods
     * @var string $policy
     */
    public static $policy = DonationPolicy::class;
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
    public static $icon = '<i class="fa-solid fa-money-bill"></i>'; // put <i> tag or icon name
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
        'love_donation',
        'ongoing_charity',
        'currency_id',
        'status',
        'campaign_id'
    ];
    /**
     *  if you want define relationship searches
     *  one or Multiple Relations
     * 	Example: method=> 'invoices'  => columns=>['title'],
     * @var array<string, mixed> $searchWithRelation
     */
    public static $searchWithRelation = [];
    /**
     * if you need to custom resource name in menu navigation
     * @return string
     */
    public static function customName()
    {
        return __('campaigns::main.donations');
    }

    /**
     * you can define vertext in header of page like (Card,HTML,view blade)
     * @return array<string>
     */
    public static function vertex()
    {
        return [
            (new AllDonations)->render(),
            (new DoneDonations)->render(),
            (new PendingDonations)->render(),
            (new RejectedDonations)->render(),
        ];
    }/*  */

    /**
     * define fields by Helpers
     * @return array<string>
     */
    public function fields()
    {
        return [
            text(__('dash::dash.name'), 'name')
                ->rule('required', 'string')
                ->column(4),

            email(__('campaigns::main.email'), 'email')
                ->rule('required', 'email')
                ->column(4),

            tel(__('campaigns::main.mobile'), 'mobile')
                ->rule('required', 'string')
                ->column(4),

            select(__('campaigns::main.love_donation'), 'love_donation')
                ->options([
                    'yes'  => __('campaigns::main.yes'),
                    'no' => __('campaigns::main.no'),
                ])
                ->rule('required', 'in:yes,no')
                ->column(4)
                ->f(true, ['column' => 3]),

            text(__('campaigns::main.love_name'), 'love_name')
                ->rule('required_if:love_donation,yes', 'sometimes')
                ->column(4)
                ->hideInIndex(),

            email(__('campaigns::main.love_email'), 'love_email')
                ->rule('required_if:love_donation,yes', 'sometimes')
                ->column(4)
                ->hideInIndex(),
            tel(__('campaigns::main.love_mobile'), 'love_mobile')
                ->rule('required_if:love_donation,yes', 'sometimes')
                ->column(4)
                ->hideInIndex(),

            textarea(__('campaigns::main.love_comment'), 'love_comment')
                ->rule('required_if:love_donation,yes', 'sometimes')
                ->column(12)
                ->hideInIndex(),

            number(__('campaigns::main.amount '), 'amount')
                ->rule('required')
                ->column(4),

            select(__('campaigns::main.ongoing_charity'), 'ongoing_charity')
                ->options([
                    'yes'  => __('campaigns::main.yes'),
                    'no'   => __('campaigns::main.no'),
                ])
                ->rule('required', 'in:yes,no')
                ->column(4)
                ->f(true, ['column' => 3]),

            number(__('campaigns::main.charity_amount'), 'charity_amount')
                ->rule('required_if:ongoing_charity,yes', 'sometimes')
                ->column(4),

            belongsTo()->make(__('campaigns::main.currency'), 'currency', Currencies::class)
                ->column(4)
                ->f(true, ['column' => 3])
                ->rule('required'),

            number(__('campaigns::main.usd_rate'), 'usd_rate')
                ->rule('required')
                ->column(4),

            number(__('campaigns::main.usd_convert'), 'total_usd')
                ->rule('required')
                ->column(4),

            number(__('campaigns::main.myr_rate'), 'myr_rate')
                ->rule('required')
                ->column(4),

            number(__('campaigns::main.myr_convert'), 'total_myr')
                ->rule('required')
                ->column(4),

            text(__('campaigns::main.gateway'), 'gateway')
                ->rule('required')
                ->column(4),


            belongsTo()->make(__('campaigns::main.campaign'), 'campaign', Campaigns::class)
                ->column(6)
                ->rule('required')
                ->f(true, ['column' => 3]),

            select()->make(__('campaigns::main.status'), 'status')
                ->options([
                    'pending'      => __('campaigns::main.pending'),
                    'done'         => __('campaigns::main.done'),
                    'cancelled'    => __('campaigns::main.cancelled'),
                    'rejected'     => __('campaigns::main.rejected'),
                ])->column(6)
                ->f(true, ['column' => 3])
                ->rule('required', 'in:pending,done,cancelled,rejected'),

            custom('transaction_json', __('campaigns::main.transaction_details'))
                ->view('campaigns::donations.transaction_json')
                ->hideInIndex()
                ->column(12),
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
