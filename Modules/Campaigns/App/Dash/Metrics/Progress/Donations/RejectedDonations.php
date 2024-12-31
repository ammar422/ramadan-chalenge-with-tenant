<?php

namespace Modules\Campaigns\App\Dash\Metrics\Progress\Donations;

use Dash\Extras\Metrics\Progress;
use Modules\Campaigns\App\Models\Donation;

class RejectedDonations extends Progress
{

    /**
     * calculate method is short to calc to using in value
     * for more information about this visit https://phpdash.com/docs/1.x/Metrics#Value
     * @return $this->progress method
     *
     */
    public function calc()
    {
        return  $this->progress(Donation::class, function ($query) {
            $query->where('status', 'rejected');
        })
            ->bgClass('bg-danger')
            ->column(4)
            ->icon('<i class="fa-solid fa-hand-holding-dollar"></i>')
            ->title(__('campaigns::main.rejected_donations'))
            ->prefix('<i class="fa-solid fa-hand-holding-dollar"></i>')
        ;
    }
}
