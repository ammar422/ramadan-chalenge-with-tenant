<?php

namespace Modules\Campaigns\App\Models;

use Modules\Users\App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Modules\Countries\App\Models\Country;
use Modules\Categories\App\Models\Category;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Campaigns\Database\Factories\CampaignFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Campaign extends Model implements TranslatableContract
{
    use HasFactory, HasUuids, SoftDeletes, Translatable;

    /**
     * Translatable attributes.
     *
     * @var array<int, string>
     */
    public $translatedAttributes = [
        'name',
        'content'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'video_url',
        'start_at',
        'end_at',
        'total_days',
        'total_donors',
        'total_amount',
        'is_public',
        'currency_id',
        'user_id',
        'sort',
        'status',
        'price_target',
        'category_id'
    ];

    /**
     * The attributes that should be appended to the model.
     *
     * @var array<int, string>
     */
    protected  $appends  = [
        'remaining_days',
    ];

    /**
     * The custom date format for the model.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d h:i:s';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total_amount'      => 'float',
        'remaining_days'    => 'integer',
        'price_target'      => 'float',
        'start_at'          => 'datetime',
        'end_at'            => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            if (admin()) {
                $model->user_id = admin()->id;
            }
            $model->total_days = $model->start_at->diffInDays($model?->end_at);
        });
    }

    /**
     * Get the remaining days for the campaign.
     *
     * @return int
     */
    public function getRemainingDaysAttribute()
    {
        return !empty($this->end_at) ? now()->diffInDays($this->end_at) : 0;
    }

    /**
     * Format the created_at attribute.
     *
     * @param string|null $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return now()->parse($value)->format('Y-m-d h:is');
    }
    /**
     * Format the updated_at attribute.
     *
     * @param string|null $value
     * @return string
     */
    public function getUpdatedAtAttribute($value)
    {
        return now()->parse($value)->format('Y-m-d h:is');
    }


    // end Accessors and Mutators



    // start Relationships

    /**
     * Get donations associated with the campaign.
     *
     * @return HasMany<Donation>
     */
    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * Get the currency associated with the campaign.
     *
     * @return BelongsTo<Country, self>
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the user who owns the campaign.
     *
     * @return BelongsTo<User, self>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category associated with the campaign.
     *
     * @return BelongsTo<Category, self>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the updates associated with the campaign.
     *
     * @return HasMany<CampaignUpdate>
     */
    public function updates(): HasMany
    {
        return $this->hasMany(CampaignUpdate::class);
    }
    // end Relationships


    //factory

    /**
     * Create a new factory instance for the model.
     *
     * @return CampaignFactory
     */
    protected static function newFactory(): CampaignFactory
    {
        return CampaignFactory::new();
    }
}
