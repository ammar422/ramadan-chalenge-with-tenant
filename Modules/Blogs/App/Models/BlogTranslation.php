<?php

namespace Modules\Blogs\App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class BlogTranslation extends Model
{
    use HasUuids;
    public $timestamps = false;
    protected $fillable = ['title', 'description', 'content'];
}
