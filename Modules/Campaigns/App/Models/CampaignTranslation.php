<?php

namespace Modules\Campaigns\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class CampaignTranslation extends Model
{
    use  HasUuids;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'locale',
        'campaign_id',
        'name',
        'content',
    ];

}
