<?php

namespace Modules\Countries\App\Dash\Metrics\Values;

use Dash\Extras\Metrics\Value;
use Modules\Countries\App\Models\City;

class AllCities extends Value
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
            $this->count(City::class)
            ->column(3)
            ->href(dash('resource/Cities'))
            ->icon('<i class="fa-solid fa-flag"></i>')
            ->title(__('dash.Cities'))
            ->prefix('<i class="fa-solid fa-flag"></i>');
    }

    /**
     * ranges
     * enable dropdown select to set range to count or sum data you can add more by days like 730
     * @return array<string>
     */
    public function ranges()
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
