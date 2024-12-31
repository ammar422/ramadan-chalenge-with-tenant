<?php

namespace Modules\WebLinks\App\Models;

use App\Models\User;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\WebLinks\Database\Factories\WeblinkFactory;

class Weblink extends Model implements TranslatableContract
{
    use HasFactory, HasUuids, SoftDeletes, Translatable;

    /**
     * @var array<string>
     */
    public $translatedAttributes = ['name'];
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'url',
        'status',
        'place',
        'user_id',
        'weblink_id'
    ];
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (admin())
                $model->user_id = admin()->id;
        });
    }


    /**
     * @return BelongsTo<User,Weblink>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Weblink,Weblink>
     */
    public function weblink(): BelongsTo
    {
        return $this->belongsTo(Weblink::class, 'weblink_id');
    }

    /**
     * @return HasMany<Weblink>
     */
    public function weblinks(): HasMany
    {
        return $this->hasMany(Weblink::class, 'weblink_id');
    }


    /**
     * @return WeblinkFactory
     */
    protected static function newFactory(): WeblinkFactory
    {
        return WeblinkFactory::new();
    }
}
