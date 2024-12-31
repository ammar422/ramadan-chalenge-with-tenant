<?php

namespace Modules\Videos\App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param mixed $request
     * 
     * @return array<array<string>>
     */
    public function toArray($request): array
    {
        return [
            'id'            =>  $this->id,
            'title'         =>  $this->title,
            'video_url'     =>  $this->video_url,
            'created_at'    =>  $this->created_at,
            'updated_at'    =>  $this->updated_at,
            'user'          =>
            [
                'id'    => $this->user->id,
                'name'  => $this->user->name,
            ]
        ];
    }
}
