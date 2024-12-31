<?php

namespace Modules\Pages\App\Dash\Metrics\Progress;

use Dash\Extras\Metrics\Progress;
use Modules\Pages\App\Models\Page;

class DisablePages extends Progress
{

    /**
     * calculate method is short to calc to using in value
     * for more information about this visit https://phpdash.com/docs/1.x/Metrics#Value
     * @return $this->progress method
     *
     */
    public function calc()
    {
        return  $this->progress(Page::class, function ($query) {
            $query->where('status', 'disable');
        })
            ->bgClass('bg-danger')
            ->column(4)
            ->icon('<i class="fa-solid fa-file"></i>')
            ->title(__('pages::main.disable_pages'))
            ->prefix('<i class="fa-solid fa-file"></i>')
        ;
    }
}
