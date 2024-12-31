<?php
namespace Modules\Campaigns\App\Dash\Metrics\Values;
use Dash\Extras\Metrics\Value;
use Modules\Campaigns\App\Models\Campaign;

class AllCampaigns extends Value{

    /**
     * calculate method is short to calc to using in value
     * for more information about this visit https://phpdash.com/docs/1.x/Metrics#Value
     * @return $this->sum or count method
     *
     */
      public function calc(){
        return
        $this->count(Campaign::class) 
       ->column(4) 
       ->href(dash('resource/Campaigns'))
       ->icon('<i class="fa-solid fa-hand-holding-dollar"></i>') 
       ->title(__('dash.Campaigns')) 
       ->prefix('<i class="fa-solid fa-hand-holding-dollar"></i>');
    }

     /**
     * ranges
     * enable dropdown select to set range to count or sum data you can add more by days like 730
     * @return array<string>
     */
    public function ranges(){
        return [
            'all'=>'All',
            'today'=>'Today',
            'yesterday'=>'Yesterday',
            '3'=>'last 3 days',
            '4'=>'last 4 days',
            'week'=>'Week',
            'month'=>'month',
            'year'=>'year',
            '730'=>'2 years',
        ];
    }

}
