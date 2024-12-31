<?php

namespace Modules\Partners\App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class PartnerTranslation extends Model
{
    use HasUuids;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name'];
}
