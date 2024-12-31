<?php

namespace Modules\Countries\App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class CityTranslation extends Model
{
    use HasUuids;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name'];
}
