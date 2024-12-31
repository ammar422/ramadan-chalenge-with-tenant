<?php

namespace Modules\Socials\App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Socials\Database\Factories\SocialFactory;

class Social extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = [
        'id',
        'name',
        'url',
        'icon'
    ];



    protected static function newFactory(): SocialFactory
    {
        return SocialFactory::new();
    }
}
