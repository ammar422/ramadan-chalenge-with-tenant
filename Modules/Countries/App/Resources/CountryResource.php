<?php

namespace Modules\Countries\App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'mob_code'          => $this->mob_code,
            'iso'               => $this->iso,
            'currency_name'     => $this->currency_name,
            'currency_rate'     => $this->currency_rate,
            'currency_symbol'   => $this->currency_symbol

        ];
    }
}
