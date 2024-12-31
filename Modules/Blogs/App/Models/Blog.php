<?php

namespace Modules\Blogs\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Blogs\Database\Factories\BlogFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model  implements TranslatableContract
{
    use HasFactory, HasUuids, SoftDeletes, Translatable;

    /**
     * @var string[]
     */
    public $translatedAttributes = ['title', 'description', 'content'];
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'image',
        'video',
        'status',
        'user_id'
    ];
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (admin()) {
                $model->user_id = admin()->id;
            }
        });
    }

    /**
     * @return BelongsTo<User, Blog>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return MorphMany<\Dash\Models\FileManagerModel>
     */
    public function files(): MorphMany
    {
        return $this->morphMany(\Dash\Models\FileManagerModel::class, 'file');
    }

    /**
     * @return BlogFactory
     */
    protected static function newFactory(): BlogFactory
    {
        return BlogFactory::new();
    }
}
