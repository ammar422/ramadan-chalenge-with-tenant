<?php

namespace Modules\Videos\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class VideoTranslation extends Model
{

    use HasUuids;

    /**
     * @var bool
     */
    public $timestamps = false;

   
    protected $fillable = ['title'];
}
