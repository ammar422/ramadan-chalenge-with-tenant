<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Setting extends Model
{
    use HasFactory, HasUuids, SoftDeletes;


    protected $fillable = [
        'logo',
        'icon',
        'site_name',
        'maintenance_mode',
        'description',
        'keywords',
    ];

    protected $casts  = [
        // 'maintenance_mode' => 'boolean',
        'description' => 'string',
    ];
}
