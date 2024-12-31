<?php

namespace Modules\Stories\App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Stories\Database\Factories\StoryFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;


class Story extends Model implements TranslatableContract
{
    use HasFactory, HasUuids, SoftDeletes, Translatable;

    /**
     * @var array<string>
     */
    public $translatedAttributes = [
        'title',
        'content',
    ];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'image',
    ];

    protected static function newFactory(): StoryFactory
    {
        return StoryFactory::new();
    }
}
