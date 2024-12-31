<?php

namespace Modules\SlideShows\App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SlideShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {

        $type    = $this->slide_type == 'image' ? "image" : 'video';
        $media  = $this->slide_type == 'image' ? $this->image : $this->video;
        return [
            'id'            => $this->id,
            "title"         => $this->title,
            "content"       => $this->content,
            "url_title"     => $this->url_title,
            "url"           => $this->url,
            'slide_type'    => $this->slide_type,
            $type           => $media,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,

            'user'          => [
                'id'    =>  $this->user->id,
                'name'  =>  $this->user->name,
            ]
        ];
    }
}