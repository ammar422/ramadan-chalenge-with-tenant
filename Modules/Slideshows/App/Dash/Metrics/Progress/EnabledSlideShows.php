<?php
namespace Modules\SlideShows\App\Dash\Metrics\Progress;
use Dash\Extras\Metrics\Progress;
use Modules\SlideShows\App\Models\SlideShow;

class EnabledSlideShows extends Progress{

    /**
     * calculate method is short to calc to using in value
     * for more information about this visit https://phpdash.com/docs/1.x/Metrics#Value
     * @return $this->progress method
     *
     */
    public function calc()
    {
        return  $this->progress(SlideShow::class, function ($query) {
            $query->where('status', 'show');
        })
            ->bgClass('bg-success')
            ->column(4)
            ->icon('<i class="fa-solid fa-chart-column"></i>')
            ->title(__('slideshows::main.enabled_slideshows'))
            ->prefix('<i class="fa-solid fa-chart-column"></i>')
        ;
    }



}
