<?php

namespace Modules\Campaigns\App\Dash\Metrics\Charts\Campaigns;

use Dash\Extras\Metrics\Chart;
use Modules\Campaigns\App\Models\Campaign;

class CampaignsLine extends Chart
{

    /**
     * setup your settings in Chart
     * @return array<string, mixed> Options for the chart
     */
    public function options(): array
    {
        return [
            'column'    => '6',
            'elem'      => 'CampaignsLine', // do not add hash # just clearname
            'title'     => __('dash.Campaigns'),
            'icon'      =>'<i class="fa-solid fa-hand-holding-dollar"></i>',
            'subTitle'  =>'Campaigns Line Chart',
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
                    __('campaigns::main.pending_campaigns'),
                    __('campaigns::main.published_campaigns'),
                    __('campaigns::main.ended_campaigns'),
                    __('campaigns::main.completed_campaigns'),
                    __('campaigns::main.cancelled_campaigns'),
                ],
                'datasets' => [
                    [
                        'label' => __('dash.Campaigns'),
                        'data' => [
                            Campaign::whereStatus('pending')->count(),
                            Campaign::whereStatus('published')->count(),
                            Campaign::whereStatus('ended')->count(),
                            Campaign::whereStatus('completed')->count(),
                            Campaign::whereStatus('cancelled')->count(),
                        ],
                    ]
                ]
            ],
            'icon'      => '<i class="fa-solid fa-hand-holding-dollar"></i>',
            'subTitle'  => 'Campaigns Line Chart',
        ]);
    }
}
