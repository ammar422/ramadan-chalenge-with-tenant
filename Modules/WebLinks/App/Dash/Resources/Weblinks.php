<?php

namespace Modules\WebLinks\App\Dash\Resources;

use Dash\Resource;
use Modules\Users\App\Dash\Resources\Users;
use Modules\WebLinks\App\Models\Weblink;
use Modules\WebLinks\App\Policies\WeblinkPolicy;

class Weblinks extends Resource
{

	/**
	 * define Model of resource
	 * @var string $model
	 */
	public static $model = Weblink::class;

	/**
	 * Policy Permission can handel
	 * (viewAny,view,create,update,delete,forceDelete,restore) methods
	 * @var string $policy
	 */
	public static $policy = WeblinkPolicy::class;

	/**
	 * define this resource in group to show in navigation menu
	 * if you need to translate a dynamic name
	 * define dash.php in /resources/views/lang/en/dash.php
	 * and add this key directly users
	 * @var string $group
	 */
	public static $group = 'Weblinks';

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
	public static $icon = '<i class="fa-solid fa-link"></i>'; // put <i> tag or icon name

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
		'status'
	];

	/**
	 *  if you want define relationship searches
	 *  one or Multiple Relations
	 * 	Example: method=> 'invoices'  => columns=>['title'],
	 * @var array<array<string>> $searchWithRelation
	 */
	public static $searchWithRelation = [
		'translation' => ['name'],
	];

	/**
	 * if you need to custom resource name in menu navigation
	 * @return string
	 */
	public static function customName()
	{
		return __('weblinks::main.weblinks');
	}

	/**
	 * you can define vertext in header of page like (Card,HTML,view blade)
	 * @return array<string>
	 */
	public static function vertex()
	{
		return [];
	}

	/**
	 * define fields by Helpers
	 * @return array<string>
	 */
	public function fields()
	{
		return [
			text(__('weblinks::main.name'), 'name')
				->translatable(config('dash.DASHBOARD_LANGUAGES'))
				->rule('required', 'string')
				->f(),

			select(__('weblinks::main.place'), 'place')
				->options([
					'header'   => __('weblinks::main.header'),
					'footer'   => __('weblinks::main.footer'),
				])->column(4)
				->rule('required', 'in:header,footer')
				->f(),

			text(__('weblinks::main.url'), 'url')
				->rule('url', 'required')
				->hideInIndex()
				->column(4)
				->f(),

			select(__('weblinks::main.status'), 'status')
				->options([
					'hide'   => __('weblinks::main.hide'),
					'show'   => __('weblinks::main.show'),
				])->column(4)
				->rule('required', 'in:hide,show')
				->f(),

			belongsTo()->make(__('weblinks::main.user_id'), 'user', Users::class)
				->rule('required')
				->hideInCreate()
				->hideInUpdate()
				->showInIndex()
				->f(),

			belongsTo(__('weblinks::main.weblink_id'), 'weblink', Weblinks::class),

			hasMany(__('weblinks::main.childs'), 'weblinks', Weblinks::class)->use('weblink')->hideInIndex()
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
