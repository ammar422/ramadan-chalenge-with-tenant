<?php

namespace Modules\Faqs\App\Dash\Resources;

use Dash\Resource;
use Modules\Faqs\App\Models\Faq;
use Modules\Faqs\App\Policies\FaqPolicy;
use Modules\Faqs\App\Dash\Metrics\Values\AllFaqs;

class Faqs extends Resource
{

	/**
	 * define Model of resource
	 * @var string $model
	 */
	public static $model = Faq::class;

	/**
	 * Policy Permission can handel
	 * (viewAny,view,create,update,delete,forceDelete,restore) methods
	 * @var string $policy
	 */
	public static $policy = FaqPolicy::class;

	/**
	 * define this resource in group to show in navigation menu
	 * if you need to translate a dynamic name
	 * define dash.php in /resources/views/lang/en/dash.php
	 * and add this key directly users
	 * @var string $group
	 */
	public static $group = 'Faqs';

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
	public static $icon = '<i class="fa fa-question" aria-hidden="true"></i>'; // put <i> tag or icon name

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
		'title',
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
		return __('dash.Faqs');
	}

	/**
	 * you can define vertext in header of page like (Card,HTML,view blade)
	 * @return array<string>
	 */
	public static function vertex()
	{
		return [
			(new AllFaqs)->render(),
		];
	}

	/**
	 * define fields by Helpers
	 * @return array<string>
	 */
	public function fields()
	{
		return [
			text(__('faqs::main.title'), 'title')
				->translatable(config('dash.DASHBOARD_LANGUAGES'))
				->rule('required', 'string'),

			ckeditor(__('faqs::main.content'), 'content')
				->translatable(config('dash.DASHBOARD_LANGUAGES'))
				->rule('required', 'string')
				->hideInIndex(),
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
