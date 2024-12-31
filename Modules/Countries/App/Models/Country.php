<?php

namespace Modules\Countries\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Countries\Database\Factories\CountryFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Campaigns\App\Models\Donation;

class Country extends Model implements TranslatableContract
{
    use HasFactory, HasUuids, SoftDeletes, Translatable;
    
    /**
     * Translatable attributes.
     *
     * @var array<int, string>
     */
    public $translatedAttributes = ['currency_name', 'name'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'currency_rate',
        'currency_symbol',
        'iso',
        'mob_code',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'currency_rate' => 'float',
        'mob_code' => 'integer',
    ];


    //realtionships

    /**
     * Get the cities associated with the country.
     *
     * @return HasMany<City>
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    /**
     * Get the donations associated with the country.
     *
     * @return HasMany<Donation>
     */
    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class, 'country_id', 'id');
    }

    //factory

     /**
     * Create a new factory instance for the model.
     *
     * @return CountryFactory
     */
    protected static function newFactory(): CountryFactory
    {
        return CountryFactory::new();
    }
}
