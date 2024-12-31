<?php

namespace Modules\Campaigns\App\Dash\Metrics\Progress\Campaigns;

use Dash\Extras\Metrics\Progress;
use Modules\Campaigns\App\Models\Campaign;

class CancelledCampaigns extends Progress
{

    /**
     * calculate method is short to calc to using in value
     * for more information about this visit https://phpdash.com/docs/1.x/Metrics#Value
     * @return $this->progress method
     *
     */
    public function calc()
    {
        return  $this->progress(Campaign::class, function ($query) {
            $query->where('status', 'cancelled');
        })
            ->bgClass('bg-warning')
            ->column(4)
            ->icon('<i class="fa-solid fa-hand-holding-dollar"></i>')
            ->title(__('campaigns::main.cancelled_campaigns'))
            ->prefix('<i class="fa-solid fa-hand-holding-dollar"></i>')
        ;
    }
}
