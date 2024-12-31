<?php

namespace Modules\Stories\App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'image'       => $this->image,
            'title'       => $this->title,
            'content'     => $this->content,

        ];
    }
}
