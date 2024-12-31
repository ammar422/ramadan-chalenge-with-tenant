<?php

namespace Modules\Campaigns\App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DonationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        // return parent::toArray($request);

        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'email'             => $this->email,
            'mobile'            => $this->mobile,
            'love_donation'     => $this->love_donation,
            'love_name'         => $this->love_name,
            'love_email'        => $this->love_email,
            'love_mobile'       => $this->love_mobile,
            'love_comment'      => $this->love_comment,
            'ongoing_charity'   => $this->ongoing_charity,
            'total_amount'      => $this->total_amount,
            'usd_rate'          => $this->usd_rate,
            'usd_convert'       => $this->usd_convert,
            'charity_amount'    => $this->charity_amount,
            'gateway'           => $this->gateway,
            'transaction_json'  => json_decode($this->transaction_json),
            'status'            => $this->status,
            'campaign'  => [
                'id'    => $this->campaign->id,
                'name'  => $this->campaign->name,
            ],
            'country'  => [
                'id'        => $this->currency->id,
                'name'      => $this->currency->name,
                'currency'  => $this->currency->currency_name,
            ]
        ];
    }
}
