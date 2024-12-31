<?php

namespace Modules\Categories\App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    use HasUuids;

    public $timestamps = false;

    protected $fillable = ['name'];
}
