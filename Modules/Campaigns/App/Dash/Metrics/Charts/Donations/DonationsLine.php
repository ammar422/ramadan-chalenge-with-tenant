<?php

namespace Modules\Campaigns\App\Dash\Metrics\Charts\Donations;

use Dash\Extras\Metrics\Chart;
use Modules\Campaigns\App\Models\Donation;

class DonationsLine extends Chart
{

    /**
     * setup your settings in Chart
     * @return array<string, mixed> Options for the chart
     */
    public function options(): array
    {
        return [
            'column'    => '6',
            'elem'      => 'DonationsLine', // do not add hash # just clearname
            'title'     => __('dash.Donations'),
            'icon'      => '<i class="fa-solid fa-money-bill"></i>',
            'subTitle'  => 'Donations Line Chart',
        ];
    }

    /**
     * calculate method is short to calc to set dataset in chart
     * You Can Set Type Using | doughnut , line , bar ,polarArea , radar, scatter, bubble , mixed
     * this chart based on ChartJs visit https://www.chartjs.org/docs/latest
     * to get your main setting  to set your chart
     * for more information about this visit https://phpdash.com/docs/1.x/Metrics#chart
     * @return $this->data method
     *
     */
    public function calc()
    {
        return $this->data([
            'type' => 'line',
            'data' => [
                'labels' => [
                    __('campaigns::main.pending_donations'),
                    __('campaigns::main.done_donations'),
                    __('campaigns::main.cancelled_donations'),
                    __('campaigns::main.rejected_donations'),
                ],
                'datasets' => [
                    [
                        'label' =>  __('dash.Donations'),
                        'data' => [
                            Donation::whereStatus('pending')->count(),
                            Donation::whereStatus('done')->count(),
                            Donation::whereStatus('cancelled')->count(),
                            Donation::whereStatus('rejected')->count(),
                        ],
                    ]
                ]
            ],
            'icon'      => '<i class="fa-solid fa-money-bill"></i>',
            'subTitle'  => 'Donations Line Chart',
        ]);
    }
}
