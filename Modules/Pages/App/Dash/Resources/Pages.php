<?php

namespace Modules\Pages\App\Dash\Resources;

use Dash\Resource;
use Modules\Pages\App\Models\Page;
use Modules\Pages\App\Policies\PagePolicy;
use Modules\Pages\App\Dash\Metrics\Values\AllPages;
use Modules\Pages\App\Dash\Metrics\Progress\EnablePages;
use Modules\Pages\App\Dash\Metrics\Progress\DisablePages;

class Pages extends Resource
{

    /**
     * define Model of resource
     * @var string $model
     */
    public static $model = Page::class;

    /**
     * Policy Permission can handel
     * (viewAny,view,create,update,delete,forceDelete,restore) methods
     * @var string $policy
     */
    public static $policy = PagePolicy::class;

    /**
     * define this resource in group to show in navigation menu
     * if you need to translate a dynamic name
     * define dash.php in /resources/views/lang/en/dash.php
     * and add this key directly users
     * @var string $group
     */
    public static $group = 'Settings.Pages';

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
    public static $icon = '<i class="fa-solid fa-file"></i>'; // put <i> tag or icon name

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
        'content',
        'status',
    ];

    /**
     *  if you want define relationship searches
     *  one or Multiple Relations
     * 	Example: method=> 'invoices'  => columns=>['title'],
     * @var array<string, array<int, string>>
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
        return __('dash.Pages');
    }

    /**
     * you can define vertext in header of page like (Card,HTML,view blade)
     * @return array<string>
     */
    public static function vertex()
    {
        return [
            (new AllPages)->render(),
            (new EnablePages)->render(),
            (new DisablePages)->render(),
        ];
    }

    /**
     * define fields by Helpers
     * @return array<string>
     */
    public function fields()
    {
        return [
            text(__('pages::main.name'), 'name')
                ->translatable(config('dash.DASHBOARD_LANGUAGES'))
                ->column(6)
                ->rule('required', 'string'),

            select(__('pages::main.status'), 'status')
                ->options([
                    'show'     => __('pages::main.show'),
                    'hide'     => __('pages::main.hide'),
                ])
                ->rule('required', 'in:enable,disable')
                ->column(6)
                ->f(),

            ckeditor(__('pages::main.content'), 'content')
                ->translatable(config('dash.DASHBOARD_LANGUAGES'))
                ->hideInIndex()
                ->rule('required', 'string'),

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
