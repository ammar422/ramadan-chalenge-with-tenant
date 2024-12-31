<?php

namespace Modules\Partners\App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Partners\Database\Factories\PartnerFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Partner extends Model implements TranslatableContract
{
    use HasFactory, SoftDeletes, HasUuids, Translatable;


    /**
     * @var array<string>
     */
    public $translatedAttributes = ['name'];
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'image',
        'status'
    ];



    // public function getCreatedAtAttribute($value)
    // {
    //     return now()->parse($value)->format('Y-m-d h:is');
    // }



    protected static function newFactory(): PartnerFactory
    {
        return PartnerFactory::new();
    }
}
