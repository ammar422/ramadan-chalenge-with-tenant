<?php

namespace Modules\Faqs\App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class FaqTranslation extends Model
{
    use  HasUuids;


    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'content'
    ];
}
