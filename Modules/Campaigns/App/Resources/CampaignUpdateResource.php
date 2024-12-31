<?php
namespace Modules\Campaigns\App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CampaignUpdateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id'        => $this->id,
            'title'     => $this->title,
            'content'   => $this->content,
            'image'     => $this->image
        ];
    }
}
