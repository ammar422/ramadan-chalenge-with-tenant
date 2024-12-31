<?php

namespace Modules\WebLinks\App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class WeblinkTranslation extends Model
{
    use HasUuids;
    /**
     * @var bool
     */
    public $timestamps = false;
    protected $fillable = ['name'];

}
