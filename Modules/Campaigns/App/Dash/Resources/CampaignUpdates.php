<?php

namespace Modules\Campaigns\App\Dash\Resources;

use Dash\Resource;
use Modules\Users\App\Dash\Resources\Users;
use Modules\Campaigns\App\Models\CampaignUpdate;
use Modules\Campaigns\App\Policies\CampaignUpdatePolicy;

class CampaignUpdates extends Resource
{

	/**
	 * define Model of resource
	 * @var string $model
	 */
	public static $model = CampaignUpdate::class;

	/**
	 * Policy Permission can handel
	 * (viewAny,view,create,update,delete,forceDelete,restore) methods
	 * @var string $policy
	 */
	public static $policy = CampaignUpdatePolicy::class;

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
	public static $icon = '<i class="fa-solid fa-bars-progress"></i>'; // put <i> tag or icon name

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
		'title',
		'content',
		'status',
		'user_id'
	];

	/**
	 *  if you want define relationship searches
	 *  one or Multiple Relations
	 * 	Example: method=> 'invoices'  => columns=>['title'],
	 * @var array<string, mixed> $searchWithRelation
	 */
	public static $searchWithRelation = [
		'translation' => ['title', 'content']
	];

	/**
	 * if you need to custom resource name in menu navigation
	 * @return string
	 */
	public static function customName()
	{
		return __('dash.CampaignUpdates');
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
			text(__('campaigns::main.title'), 'title')
				->translatable(config('dash.DASHBOARD_LANGUAGES'))
				->rule('required', 'string')
				->column(12)
				->f(),
			ckeditor(__('campaigns::main.content'), 'content')
				->translatable(config('dash.DASHBOARD_LANGUAGES'))
				->rule('required')
				->column(12)
				->hideInIndex()
				->f(),
			dropzone()->make(__('blogs::main.attachments'), 'files')
				->autoQueue(true) //true|false
				->maxFileSize(10) //mb
				->maxFiles(30) // files
				->parallelUploads(20) //files
				->thumbnailWidth(80) //px
				->thumbnailHeight(80) //px
				->acceptedMimeTypes('video/*', 'image/*')
				->hideInIndex(),
			image(__('campaigns::main.image'), 'image')
				->ruleWhenCreate('required', 'image', 'mimes:jpeg,png,svg|max:2048')
				->ruleWhenUpdate('sometimes', 'image', 'mimes:jpeg,png,svg|max:2048')
				->column(4),
			select(__('campaigns::main.status'), 'status')
				->options([
					'hide'   => __('campaigns::main.hide'),
					'show' => __('campaigns::main.show'),
				])
				->rule('required', 'in:hide,show')
				->column(4)
				->f(),
			belongsTo(__('campaigns::main.campaign'), 'campaign', Campaigns::class)
				->column(4)
				->rule('required', 'string')
				->f(),
			belongsTo(__('campaigns::main.user_id'), 'user', Users::class)
				->column(4)
				->onlyIndex()
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
