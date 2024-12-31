<?php

namespace Modules\Faqs\App\Dash\Metrics\Values;

use Dash\Extras\Metrics\Value;
use Modules\Faqs\App\Models\Faq;

class AllFaqs extends Value
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
            $this->count(Faq::class)
            ->column(3)
            ->href(dash('resource/Faqs'))
            ->icon('<i class="fa fa-question" aria-hidden="true"></i>')
            ->title(__('dash.Faqs'))
            ->prefix('<i class="fa fa-question" aria-hidden="true"></i>');
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
