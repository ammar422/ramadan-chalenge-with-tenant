<?php

namespace Modules\Categories\App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Modules\Categories\Database\Factories\CategoryFactory;

class Category extends Model implements TranslatableContract
{
    use HasFactory, HasUuids, SoftDeletes, Translatable;

    /**
     * Translatable attributes.
     *
     * @var array<int, string>
     */
    public $translatedAttributes = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image'
    ];

    /**
     * Create a new factory instance for the model.
     *
     * 
     * @return CategoryFactory
     */
    protected static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }
}
