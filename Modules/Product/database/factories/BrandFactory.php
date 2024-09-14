<?php

namespace Modules\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Product\Models\Brand::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => ['en' => $this->faker->name, 'ka' => $this->faker->name],
            'slug' => ['en' => $this->faker->name, 'ka' => $this->faker->name],
            'description' => ['en' => $this->faker->sentence, 'ka' => $this->faker->sentence],
        ];
    }
}

