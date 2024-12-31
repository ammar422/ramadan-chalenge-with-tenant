<?php

namespace Modules\SlideShows\App\Dash\Resources;

use Dash\Resource;
use Modules\Users\App\Dash\Resources\Users;
use Modules\SlideShows\App\Models\SlideShow;
use Modules\SlideShows\App\Policies\SlideShowPolicy;
use Modules\SlideShows\App\Dash\Metrics\Values\AllSlideShows;
use Modules\SlideShows\App\Dash\Metrics\Progress\ImagesSlideShows;
use Modules\SlideShows\App\Dash\Metrics\Progress\VideosSlideShows;
use Modules\SlideShows\App\Dash\Metrics\Progress\EnabledSlideShows;
use Modules\SlideShows\App\Dash\Metrics\Progress\DisabledSlideShows;

class SlideShows extends Resource
{

    /**
     * define Model of resource
     * @var string $model
     */
    public static $model = SlideShow::class;

    /**
     * Policy Permission can handel
     * (viewAny,view,create,update,delete,forceDelete,restore) methods
     * @var string $policy
     */
    public static $policy = SlideShowPolicy::class;

    /**
     * define this resource in group to show in navigation menu
     * if you need to translate a dynamic name
     * define dash.php in /resources/views/lang/en/dash.php
     * and add this key directly users
     * @var string $group
     */
    public static $group = 'Settings.SlideShows';

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
    public static $icon = '<i class="fa-solid fa-chart-column"></i>'; // put <i> tag or icon name

    /**
     * title static property to labels in Rows,Show,Forms
     * @var string $title
     */
    public static $title = 'title';

    /**
     * defining column name to enable or disable search in main resource page
     * @var array<string> $search
     */
    public static $search = [
        'id',
        'image',
        'video',
        'status',
        'slide_type',
    ];

    /**
     *  if you want define relationship searches
     *  one or Multiple Relations
     * 	Example: method=> 'invoices'  => columns=>['title'],
     * @var array<array<string>> $searchWithRelation
     */
    public static $searchWithRelation = [
        'translation' => ['title', 'content', 'url_title'],
    ];

    /**
     * if you need to custom resource name in menu navigation
     * @return string
     */
    public static function customName()
    {
        return __('dash.SlideShows');
    }

    /**
     * you can define vertext in header of page like (Card,HTML,view blade)
     * @return array<string>
     */
    public static function vertex()
    {
        return [
            (new AllSlideShows)->render(),
            (new EnabledSlideShows)->render(),
            (new DisabledSlideShows)->render(),
            (new ImagesSlideShows)->render(),
            (new VideosSlideShows)->render(),
        ];
    }

    /**
     * define fields by Helpers
     * @return array<string>
     */
    public function fields()
    {
        return [

            text(__('slideshows::main.url'), 'url')
                ->rule('url', 'required')
                ->hideInIndex()
                ->column(12)
                ->f(),

            text(__('slideshows::main.title'), 'title')
                ->translatable(config('dash.DASHBOARD_LANGUAGES'))
                ->rule('required', 'string')
                ->column(6)
                ->f(),

            text(__('slideshows::main.url_title'), 'url_title')
                ->translatable(config('dash.DASHBOARD_LANGUAGES'))
                ->rule('required', 'string')
                ->column(6)
                ->f(),



            select(__('slideshows::main.slide_type'), 'slide_type')
                ->options([
                    'image'     => __('slideshows::main.image'),
                    'video'     => __('slideshows::main.video')
                ])
                ->f()
                ->column(4)
                ->rule('required', 'in:image,video'),

            select(__('slideshows::main.status'), 'status')
                ->options([
                    'show'     => __('slideshows::main.show'),
                    'hide'     => __('slideshows::main.hide')
                ])
                ->f()
                ->column(4)
                ->rule('required', 'in:show,hide'),


            ckeditor(__('slideshows::main.content'), 'content')
                ->translatable(config('dash.DASHBOARD_LANGUAGES'))
                ->rule('required')
                ->hideInIndex()
                ->f(),

            image(__('slideshows::main.image'), 'image')
                ->ruleWhenCreate('required_if:type,image', 'sometimes', 'nullable', 'image', 'mimes:jpeg,png,svg|max:2048')
                ->ruleWhenUpdate('sometimes', 'nullable', 'image', 'mimes:jpeg,png,svg|max:2048')
                ->path('SlideShows/{id}')
                ->column(6),

            video(__('slideshows::main.video'), 'video')
                ->rule('required_if:slide_type,video', 'nullable')
                ->deletable(false)
                ->column(6)
                ->disableDownloadButton()
                ->disablePreviewButton(false)
                ->playerTheme('forest')
                ->accept('video/*'),

            belongsTo()->make(__('slideshows::main.user_id'), 'user', Users::class)
                ->onlyIndex()
                ->showInShow()
                ->f(),



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
