<?php

namespace Modules\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Product\Models\Product;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => ['en' => $this->faker->name, 'ka' => $this->faker->name],
            'description' => ['en' => $this->faker->sentence, 'ka' => $this->faker->sentence],
            'slug' => ['en' => $this->faker->sentence, 'ka' => $this->faker->sentence],
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'discount' => $this->faker->numberBetween(0, 100),
            'sku' => $this->faker->uuid,
        ];
    }
}

