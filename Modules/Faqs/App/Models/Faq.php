<?php

namespace Modules\Faqs\App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Faqs\Database\Factories\FaqFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;


class Faq extends Model implements TranslatableContract
{
    use HasFactory , HasUuids , SoftDeletes , Translatable;

    /**
     * @var string[]
     */
    public $translatedAttributes = [
        'title',
        'content'
    ];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    /**
     * @return FaqFactory
     */
    protected static function newFactory(): FaqFactory
    {
        return FaqFactory::new();
    }
}
