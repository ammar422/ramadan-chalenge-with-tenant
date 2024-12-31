<?php

namespace Modules\Countries\App\Dash\Resources;

use Dash\Resource;
use Modules\Countries\App\Models\Country;
use Modules\Countries\App\Dash\Resources\Cities;
use Modules\Countries\App\Policies\CountryPolicy;
use Modules\Countries\App\Dash\Metrics\Values\AllCountries;

class Countries extends Resource
{

    /**
     * define Model of resource
     * @var string $model
     */
    public static $model = Country::class;

    /**
     * Policy Permission can handel
     * (viewAny,view,create,update,delete,forceDelete,restore) methods
     * @var string $policy
     */
    public static $policy = CountryPolicy::class;

    /**
     * define this resource in group to show in navigation menu
     * if you need to translate a dynamic name
     * define dash.php in /resources/views/lang/en/dash.php
     * and add this key directly users
     * @var string $group
     */
    public static $group = 'Countries';

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
    public static $icon = '<i class="fa-solid fa-globe"></i>'; // put <i> tag or icon name

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
        'id',
        'name',

    ];

    /**
     *  if you want define relationship searches
     *  one or Multiple Relations
     * 	Example: method=> 'invoices'  => columns=>['title'],
     * @var array<string, array<int, string>>
     */
    public static $searchWithRelation = [
        'translation' => ['name', 'currency_name'],
    ];

    /**
     * if you need to custom resource name in menu navigation
     * @return string
     */
    public static function customName()
    {
        return __('dash.countries');
    }

    /**
     * you can define vertext in header of page like (Card,HTML,view blade)
     * @return array<string>
     */
    public static function vertex()
    {
        return [
            (new AllCountries)->render(),
        ];
    }

    /**
     * define fields by Helpers
     * @return array<string>
     */
    public function fields()
    {
        return [
            //id(__('dash::dash.id'), 'id'),
            text(__('countries::main.name'), 'name')
                ->column(6)
                ->Translatable(config('dash.DASHBOARD_LANGUAGES'))
                ->rule('required', 'string'),

            text(__('countries::main.currency_name'), 'currency_name')
                ->column(6)
                ->Translatable(config('dash.DASHBOARD_LANGUAGES'))
                ->rule('required', 'string'),

            text(__('countries::main.mob_code'), 'mob_code')
                ->column(4)
                ->rule('required', 'string'),

            text(__('countries::main.currency_symbol'), 'currency_symbol')
                ->column(4)
                ->rule('required', 'string'),

            text(__('countries::main.iso'), 'iso')
                ->column(4)
                ->rule('required', 'string'),

            number(__('countries::main.currency_rate'), 'currency_rate')
                ->column(4)
                ->rule('required', 'numeric'),

            checkbox()
                ->make(__('countries::main.show_in_campaign'), 'show_in_campaign')
                ->default('no')
                ->trueVal('yes')
                ->falseVal('no'),
                
            hasMany(__('dash.Cities'), 'cities', Cities::class)->use('country')->hideInIndex(),
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
