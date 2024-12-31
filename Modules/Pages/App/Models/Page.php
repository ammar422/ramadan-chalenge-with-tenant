<?php

namespace Modules\Pages\App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Pages\Database\Factories\PageFactory;

class Page extends Model implements TranslatableContract
{
    use HasFactory, HasUuids, SoftDeletes, Translatable;

    /**
     *
     *
     * @var array<int, string>
     */
    public $translatedAttributes = ['name', 'content'];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'status'
    ];

    /**
     * @return PageFactory
     */
    protected static function newFactory(): PageFactory
    {
        return PageFactory::new();
    }
}
