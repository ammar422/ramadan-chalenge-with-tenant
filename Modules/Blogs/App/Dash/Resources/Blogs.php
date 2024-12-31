<?php

namespace Modules\Blogs\App\Dash\Resources;

use Dash\Resource;
use Modules\Blogs\App\Models\Blog;
use Modules\Blogs\App\Policies\BlogPolicy;
use Modules\Users\App\Dash\Resources\Users;

class Blogs extends Resource
{

	/**
	 * define Model of resource
	 * @var string $model
	 */
	public static $model = Blog::class;

	/**
	 * Policy Permission can handel
	 * (viewAny,view,create,update,delete,forceDelete,restore) methods
	 * @var string $policy
	 */
	public static $policy = BlogPolicy::class;

	/**
	 * define this resource in group to show in navigation menu
	 * if you need to translate a dynamic name
	 * define dash.php in /resources/views/lang/en/dash.php
	 * and add this key directly users
	 * @var string $group
	 */
	public static $group = 'Blogs';

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
	public static $icon = '<i class="fa-brands fa-twitter"></i>'; // put <i> tag or icon name

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
		'status',
		'user_id',
		'title',
		'description',
		'content'
	];

	/**
	 *  if you want define relationship searches
	 *  one or Multiple Relations
	 * 	Example: method=> 'invoices'  => columns=>['title'],
	 * @var array<string> $searchWithRelation
	 */
	public static $searchWithRelation = [];

	/**
	 * if you need to custom resource name in menu navigation
	 * @return string
	 */
	public static function customName()
	{
		return __('blogs::main.blogs');
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
			text(__('blogs::main.title'), 'title')
				->translatable(config('dash.DASHBOARD_LANGUAGES'))
				->rule('required', 'string')
				->column(12)
				->f(),
				
			textarea(__('blogs::main.description'), 'description')
				->translatable(config('dash.DASHBOARD_LANGUAGES'))
				->rule('required')
				->hideInIndex()
				->column(12)
				->f(),

			ckeditor(__('blogs::main.content'), 'content')
				->translatable(config('dash.DASHBOARD_LANGUAGES'))
				->rule('required')
				->hideInIndex()
				->column(12)
				->f(),


			text(__('blogs::main.video'), 'video')
				->rule('nullable', 'active_url', 'string')
				->hideInIndex()
				->column(4),

			image(__('blogs::main.image'), 'image')
				->ruleWhenCreate('required', 'image', 'mimes:jpeg,png,svg|max:2048')
				->ruleWhenUpdate('sometimes', 'image', 'mimes:jpeg,png,svg|max:2048')
				->path('Blogs/{id}')
				->column(4),

			dropzone()->make(__('blogs::main.attachments'), 'files')
				->autoQueue(true) //true|false
				->maxFileSize(10) //mb
				->maxFiles(30) // files
				->parallelUploads(20) //files
				->thumbnailWidth(80) //px
				->thumbnailHeight(80) //px
				->acceptedMimeTypes('video/*', 'image/*')
				->hideInIndex(),

			select(__('blogs::main.status'), 'status')
				->options([
					'hide'   => __('blogs::main.hide'),
					'show'   => __('blogs::main.show'),
				])->column(4)
				->rule('required', 'in:hide,show')
				->f(),
				
			belongsTo(__('blogs::main.user_id'), 'user', Users::class)
				->column(4)
				->f()
				->onlyIndex(),
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
