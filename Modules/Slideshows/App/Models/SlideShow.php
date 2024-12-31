<?php

namespace Modules\SlideShows\App\Models;

use Modules\Users\App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SlideShows\Database\Factories\SlideShowFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SlideShow extends Model implements TranslatableContract
{
    use HasFactory, HasUuids, SoftDeletes, Translatable;

    /**
     * @var string
     */
    protected $table = 'slideshows';


    /**
     * @var array<string>
     */
    public $translatedAttributes = ['title',  'content', 'url_title'];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'slide_type',
        'image',
        'video',
        'status',
        'user_id',
        'url'
    ];

    protected $casts = [
        'image' => 'string',
        'video' => 'string',
        'slide_type' => 'string',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $admin = admin();
            $user = $admin ? $admin : User::first();

            $model->user_id = $user ? $user->id : null; 
        });
    }

    /**
     * @return BelongsTo< User , SlideShow>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    protected static function newFactory(): SlideShowFactory
    {
        return SlideShowFactory::new();
    }
}
