<?php

namespace Modules\Videos\App\Dash\Resources;

use Dash\Resource;
use Modules\Videos\App\Models\Video;
use Modules\Users\App\Dash\Resources\Users;
use Modules\Videos\App\Policies\VideoPolicy;
use Modules\Videos\App\Dash\Metrics\Values\AllVideos;

class Videos extends Resource
{

	/**
	 * define Model of resource
	 * @var string $model
	 */
	public static $model = Video::class;

	/**
	 * Policy Permission can handel
	 * (viewAny,view,create,update,delete,forceDelete,restore) methods
	 * @var string $policy
	 */
	public static $policy = VideoPolicy::class;

	/**
	 * define this resource in group to show in navigation menu
	 * if you need to translate a dynamic name
	 * define dash.php in /resources/views/lang/en/dash.php
	 * and add this key directly users
	 * @var string $group
	 */
	public static $group = 'Videos';

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
	public static $icon = '<i class="fa-solid fa-video"></i>'; // put <i> tag or icon name

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
		'video_url',
		'user_id'
	];

	/**
	 *  if you want define relationship searches
	 *  one or Multiple Relations
	 * 	Example: method=> 'invoices'  => columns=>['title'],
	 * @var array<array<string>> $searchWithRelation
	 */
	public static $searchWithRelation = [
		'translation' => ['title']
	];

	/**
	 * if you need to custom resource name in menu navigation
	 * @return string
	 */
	public static function customName()
	{
		return __('dash.Videos');
	}

	/**
	 * you can define vertext in header of page like (Card,HTML,view blade)
	 * @return array<string>
	 */
	public static function vertex()
	{
		return [
			(new AllVideos)->render(),
		];
	}

	/**
	 * define fields by Helpers
	 * @return array<string>
	 */
	public function fields()
	{
		return [
			text(__('videos::main.title'), 'title')
				->translatable(config('dash.DASHBOARD_LANGUAGES'))
				->rule('required', 'string'),

			uri(__('videos::main.video_url'), 'video_url')
				->column(4)
				->rule('required', 'active_url')
				->hideInIndex(),

			select(__('videos::main.status'), 'status')
				->options([
					'hide'   => __('videos::main.hide'),
					'show'   => __('videos::main.show'),
				])->column(4)
				->rule('required', 'in:hide,show')
				->f(),

			belongsTo(__('videos::main.user_id'), 'user', Users::class)->column(4)->showInIndex()->f(),

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
