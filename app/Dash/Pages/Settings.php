<?php

namespace App\Dash\Pages;

use App\Models\Setting;
use Dash\Pages;
use Illuminate\Contracts\Support\Renderable;

class Settings extends Pages
{

	/**
	 * @var string $model
	 */
	public static $model    = Setting::class;

	/**
	 * @var string $icon
	 */
	public static $icon     = '<i class="fa-solid fa-gear"></i>';

	/**
	 * @var string $position
	 */
	public static $position = 'bottom'; // top|bottom


	public static $successMessage = 'Site Setting updated successfully';

	/**
	 * Rule List array
	 * @return array<string>
	 */
	public static function rule()
	{
		return [
			'site_name' 		=> 'required|string',
			'descriptions' 		=> 'sometimes|nullable|string',
			'keywords' 			=> 'sometimes|nullable|string',
			'logo' 				=> 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif',
			'icon' 				=> 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif',
			'maintenance_mode' 	=> 'required|in:on,off'

		];
	}

	/**
	 * Nicename Fields
	 * @return array<string>
	 */
	public static function attribute()
	{
		return [
			//'name' => 'Name',
		];
	}

	/**
	 * custom page name
	 * @return string
	 */
	public static function pageName()
	{
		return __('dash.Settings');
	}

	/**
	 * custom content page
	 * @return Renderable
	 */
	public static function content()
	{
		$data = Setting::first();
		return view('Settings', [
			'title'    => static::pageName(),
			'settings' => $data,
		]);
	}
}
