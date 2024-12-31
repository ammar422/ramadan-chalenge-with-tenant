<?php

namespace Modules\Campaigns\App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Campaigns\Database\Factories\CampaignUpdateFactory;
use Modules\Users\App\Models\User;

class CampaignUpdate extends Model implements TranslatableContract
{
    use HasFactory, HasUuids, SoftDeletes, Translatable;

    /**
     * Translatable attributes.
     *
     * @var array<int, string>
     */
    public $translatedAttributes = ['title', 'content'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'status',
        'user_id',
        'campaign_id'
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->user_id = !empty(admin()) ? admin()->id : auth('api')->id();
        });
    }

    /**
     * Get the user associated with the update.
     *
     * @return BelongsTo<User, self>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the campaign associated with the update.
     *
     * @return BelongsTo<Campaign, self>
     */
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }
    /**
     * Get the files associated with the update.
     *
     * @return MorphMany<\Dash\Models\FileManagerModel>
     */
    public function files(): MorphMany
    {
        return $this->morphMany(\Dash\Models\FileManagerModel::class, 'file');
    }
    /**
     * Create a new factory instance for the model.
     *
     * @return CampaignUpdateFactory
     */
    protected static function newFactory(): CampaignUpdateFactory
    {
        return CampaignUpdateFactory::new();
    }
}
