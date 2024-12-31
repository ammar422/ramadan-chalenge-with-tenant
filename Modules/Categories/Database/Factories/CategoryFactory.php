<?php

namespace Modules\Categories\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Categories\App\Models\Category;

class CategoryFactory extends Factory
{

    protected $model = Category::class;


    public function definition(): array
    {
        $fkr = fkr();
        $fkr_en = fkr('en');
        return [
            'ar' => ['name' => $fkr->name()],
            'en' => ['name' => $fkr_en->name()],
            'image' => $fkr->imageUrl(),
        ];
    }
}
