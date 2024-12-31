<?php

namespace Modules\Countries\App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'country'           => [
                'id'        => $this->country->id,
                'name'      => $this->country->name
            ],
        ];
    }
}
