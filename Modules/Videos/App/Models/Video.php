<?php

namespace Modules\Videos\App\Models;

use Modules\Users\App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Modules\Videos\Database\Factories\VideoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model implements TranslatableContract
{
    use HasFactory, Translatable, SoftDeletes, HasUuids;

    /**
     * @var array<string>
     */
    public $translatedAttributes = ['title'];

    protected $fillable = [
        'id',
        'video_url',
        'user_id',
        'status'
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
     * @return BelongsTo<User,Video>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }



    /**
     * @return VideoFactory
     */
    protected static function newFactory(): VideoFactory
    {
        return VideoFactory::new();
    }
}
