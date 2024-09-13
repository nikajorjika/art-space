<?php

namespace Modules\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Product\Models\Category;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => ['en' => $this->faker->word, 'ka' => $this->faker->word],
            'description' => ['en' => $this->faker->sentence, 'ka' => $this->faker->sentence],
            'slug' => ['en' => $this->faker->slug, 'ka' => $this->faker->slug],
        ];
    }
}

