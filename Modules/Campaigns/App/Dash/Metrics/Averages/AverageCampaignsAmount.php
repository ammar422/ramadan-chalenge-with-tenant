<?php

namespace Modules\Campaigns\App\Dash\Metrics\Averages;

use Dash\Extras\Metrics\Average;
use Modules\Campaigns\App\Models\Campaign;

class AverageCampaignsAmount extends Average
{

  /**
   * calculate method is short to calc to using in value
   * for more information about this visit https://phpdash.com/docs/1.x/Metrics#Value
   * @return $this->average method
   *
   */
  public function calc()
  {

    return $this->average(Campaign::class, 'total_amount')
      ->bgClass('bg-success')
      ->column(4)
      ->height('6')
      ->href(dash('resource/Campaigns'))
      ->icon('<i class="fa-solid fa-hand-holding-dollar"></i>')
      ->title(__('campaigns::main.average_amount'))
      ->prefix('<i class="fa-solid fa-hand-holding-dollar"></i>');
  }
}
