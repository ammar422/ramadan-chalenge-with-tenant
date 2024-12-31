<?php

namespace App\Dash\Dashboard;

use Dash\Resource;
use App\Dash\Metrics\Values\AllUsers;
use App\Dash\Metrics\Values\AllAdmins;
use App\Dash\Metrics\Values\AllAdminGroups;
use App\Dash\Metrics\Values\AllAdminGroupRoles;
use Modules\Pages\App\Dash\Metrics\Values\AllPages;
use Modules\Videos\App\Dash\Metrics\Values\AllVideos;
use Modules\Stories\App\Dash\Metrics\Values\AllStories;
use Modules\Partners\App\Dash\Metrics\Values\AllPartners;
use Modules\Campaigns\App\Dash\Metrics\Values\AllCampaigns;
use Modules\Campaigns\App\Dash\Metrics\Values\AllDonations;
use Modules\Countries\App\Dash\Metrics\Values\AllCountries;
use Modules\Slideshows\App\Dash\Metrics\Values\AllSlideShows;
use Modules\Campaigns\App\Dash\Metrics\Charts\Campaigns\CampaignsLine;
use Modules\Campaigns\App\Dash\Metrics\Charts\Donations\DonationsLine;

class Help extends Resource
{

	/**
	 * add your card here by Card , HTML Class
	 * or by view instnance render blade file
	 * @return array
	 */
	public static function cards()
	{
		return [
			(new CampaignsLine)->render(),
			(new DonationsLine)->render(),
			(new AllAdmins)->render(),
			(new AllUsers)->render(),
			(new AllAdminGroups)->render(),
			(new AllAdminGroupRoles)->render(),
			(new AllCampaigns)->render(),
			(new AllDonations)->render(),
			(new AllCountries)->render(),
			(new AllPages)->render(),
			(new AllPartners)->render(),
			(new AllSlideShows)->render(),
			(new AllStories)->render(),
			(new AllVideos)->render(),

			// view('dash::help')->render(),
			// HTML::render('<h1>Some HTML</h1>'),

		];
	}
}
