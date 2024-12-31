<?php

namespace Modules\WebLinks\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WebLinkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        // return parent::toArray($request);

        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'status'        => $this->status,
            'place'         => $this->place,
            'url'           => $this->url,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,

            'user'         => [
                'id'     => $this->user->id,
                'name'   => $this->user->name
            ],

            'parent_link'   => $this->weblink ?
                [
                    'id'    => $this->weblink->id,
                    'name'  => $this->weblink->name
                ] : null,

            'child_links'   => count($this->weblinks) > 1 ?
                $this->weblinks->map(function ($weblink) {
                    return [
                        'id'   => $weblink->id,
                        'name' => $weblink->name
                    ];
                }) : null,

        ];
    }
}
