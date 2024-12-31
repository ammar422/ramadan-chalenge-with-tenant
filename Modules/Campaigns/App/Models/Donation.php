<?php

namespace Modules\Campaigns\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Countries\App\Models\Country;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Campaigns\Database\Factories\DonationFactory;

/**
 * @property string|null $reference_id
 * @property string|null $gateway_url
 */
class Donation extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'love_donation',
        'love_name',
        'love_email',
        'love_mobile',
        'love_comment',
        'ongoing_charity',
        'amount',
        'charity_amount',
        'total_amount',
        'usd_rate',
        'total_usd',
        'myr_rate',
        'total_myr',
        'currency_id',
        'gateway',
        'status',
        'campaign_id',
        'reference_id',
        'gateway_url',
        'transaction_json',
    ];
    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'total_amount'      => 'float',
        'amount'            => 'float',
        'charity_amount'    => 'float',
        'usd_rate'          => 'float',
        'total_usd'         => 'float',
        'myr_rate'          => 'float',
        'total_myr'         => 'float',
        'transaction_json'  => 'json',
    ];
    /**
     * Boot the model and add saved hook.
     */
    protected static function boot()
    {
        parent::boot();
        static::saved(function ($model) {
            $model->campaign()->update([
                'total_donors' => $model->campaign->donations()->where('status', 'done')->count(),
                'total_amount' => $model->campaign->donations()->where('status', 'done')->sum('amount')
            ]);
        });
    }

    /**
     * Accessor for created_at attribute.
     *
     * @param string|null $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return now()->parse($value)->format('Y-m-d h:is');
    }
    /**
     * Get the campaign associated with the donation.
     *
     * @return BelongsTo<Campaign, self>
     */
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }
    /**
     * Get the currency associated with the donation.
     *
     * @return BelongsTo<Country, self>
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
    /**
     * Get a new factory instance for the donation model.
     *
     * @return DonationFactory
     */
    protected static function newFactory(): DonationFactory
    {
        return DonationFactory::new();
    }
}
