<?php

namespace Modules\Campaigns\App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class CampaignUpdateTranslation extends Model
{
    use HasUuids;
    public $timestamps = false;
    protected $fillable = [
        'title',
        'content'
    ];
}
