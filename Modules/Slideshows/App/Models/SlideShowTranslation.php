<?php

namespace Modules\SlideShows\App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class SlideShowTranslation extends Model
{
    use HasUuids;
    protected $table = 'slideshow_translations';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['title', 'content', 'url_title'];
}
