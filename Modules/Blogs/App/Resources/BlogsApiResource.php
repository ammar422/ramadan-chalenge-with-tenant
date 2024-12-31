<?php

namespace Modules\Blogs\App\Resources;

use App\Http\Resources\FileManagemer;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogsApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'description'   => $this->description,
            'content'       => $this->content,
            'image'         => $this->image,
            'video'         => $this->video,
            'attachments'   =>  $this->files->transform(function ($file) {
                return new FileManagemer($file);
            })
        ];
    }
}
