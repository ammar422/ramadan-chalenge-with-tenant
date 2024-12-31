<?php
namespace Modules\Campaigns\App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowCampaignResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id'                    => $this->id,
            'name'                  => $this->name,
            'content'               => $this->content,
            'sort'                  => $this->sort,
            'image'                 => $this->image,
            'price_target'          => $this->price_target,
            'start_at'              => $this->start_at,
            'end_at'                => $this->end_at,
            'total_days'            => $this->total_days,
            'video_url'             => $this->video_url,
            'total_donors'          => $this->total_donors,
            'total_amount'          => $this->total_amount,
            'status'                => $this->status,
            'is_public'             => $this->is_public,
            'created_at'            => $this->created_at,
            'updated_at'            => $this->updated_at,

            'currency'  => [
                'id'    => $this->currency->id,
                'name'  => $this->currency->currency_name,
            ],

            'category'  => [
                'id'    => $this->category->id,
                'name'  => $this->category->name,
            ],
            'user'      => [
                'id'    =>  $this->user->id,
                'name'  => $this->user->name
            ],
            'updates'       => CampaignUpdateResource::collection($this->updates()->paginate(request('per_page', 15)))->toResponse(app('request'))->getData(),
        ];
    }
}
