<?php

namespace Modules\Partners\App\Dash\Metrics\Progress;

use Dash\Extras\Metrics\Progress;
use Modules\Partners\App\Models\Partner;

class ShowPartners extends Progress
{

    /**
     * calculate method is short to calc to using in value
     * for more information about this visit https://phpdash.com/docs/1.x/Metrics#Value
     * @return $this->progress method
     *
     */
    public function calc()
    {
        return  $this->progress(Partner::class, function ($query) {
            $query->where('status', 'show');
        })
            ->bgClass('bg-success')
            ->column(4)
            ->icon('<i class="fa-solid fa-handshake"></i>')
            ->title(__('partners::main.show_partners'))
            ->prefix('<i class="fa-solid fa-handshake"></i>')
        ;
    }
}
