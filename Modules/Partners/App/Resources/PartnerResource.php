<?php

namespace Modules\Partners\App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        // return parent::toArray($request);
        return [
            'id'         => $this->id,
            'image'      => $this->image,
            'name'       => $this->name,
        ];
    }
}
