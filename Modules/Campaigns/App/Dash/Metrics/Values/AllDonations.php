<?php

namespace Modules\Campaigns\App\Dash\Metrics\Values;

use Dash\Extras\Metrics\Value;
use Modules\Campaigns\App\Models\Donation;

class AllDonations extends Value
{

    /**
     * calculate method is short to calc to using in value
     * for more information about this visit https://phpdash.com/docs/1.x/Metrics#Value
     * @return $this->sum or count method
     *
     */
    public function calc()
    {
        return
            $this->count(Donation::class)
            ->column(4)
            ->href(dash('resource/Donations'))
            ->icon('<i class="fa-solid fa-gift"></i>')
            ->title(__('dash.Donations'))
            ->prefix('<i class="fa-solid fa-gift"></i>')
        ;
    }
    /**
     * Returns available ranges for donations.
     *
     * @return array<int|string, string> Associative array of ranges
     */
    public function ranges(): array
    {
        return [
            'all' => 'All',
            'today' => 'Today',
            'yesterday' => 'Yesterday',
            '3' => 'last 3 days',
            '4' => 'last 4 days',
            'week' => 'Week',
            'month' => 'month',
            'year' => 'year',
            '730' => '2 years',
        ];
    }
}
