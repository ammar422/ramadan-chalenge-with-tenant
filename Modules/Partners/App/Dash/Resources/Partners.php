<?php

namespace Modules\Partners\App\Dash\Resources;

use Dash\Resource;
use Modules\Partners\App\Models\Partner;
use Modules\Partners\App\Policies\PartnerPolicy;
use Modules\Partners\App\Dash\Metrics\Values\AllPartners;
use Modules\Partners\App\Dash\Metrics\Progress\HidePartners;
use Modules\Partners\App\Dash\Metrics\Progress\ShowPartners;

class Partners extends Resource
{

	/**
	 * define Model of resource
	 * @var string $model
	 */
	public static $model = Partner::class;

	/**
	 * Policy Permission can handel
	 * (viewAny,view,create,update,delete,forceDelete,restore) methods
	 * @var string $policy
	 */
	public static $policy = PartnerPolicy::class;

	/**
	 * define this resource in group to show in navigation menu
	 * if you need to translate a dynamic name
	 * define dash.php in /resources/views/lang/en/dash.php
	 * and add this key directly users
	 * @var string $group
	 */
	public static $group = 'Partners';

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
	public static $icon = '<i class="fa-solid fa-handshake"></i>'; // put <i> tag or icon name

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
		'status',
		'name'
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
		return __('dash.Partners');
	}

	/**
	 * you can define vertext in header of page like (Card,HTML,view blade)
	 * @return array<string>
	 */
	public static function vertex()
	{
		return [
			(new AllPartners)->render(),
			(new ShowPartners)->render(),
			(new HidePartners)->render(),
		];
	}

	/**
	 * define fields by Helpers
	 * @return array<string>
	 */
	public function fields()
	{
		return [
			text(__('partners::main.name'), 'name')
				->translatable(config('dash.DASHBOARD_LANGUAGES'))
				->rule('required', 'string'),

			image(__('partners::main.image'), 'image')
				->column(4)
				->path('Partners/{id}')
				->rule('sometimes', 'nullable', 'image')
				->acceptedMimeTypes('image/*')
				->hideInIndex()
				->disableDownloadButton(),

			select(__('partners::main.status'), 'status')
				->options([
					'show'     => __('partners::main.show'),
					'hide'     => __('partners::main.hide'),
				])
				->column(4)
				->f()
				->rule('required', 'in:show,hide'),

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
