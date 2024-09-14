<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Models\Brand;
use Modules\Product\Models\Category;
use Modules\Product\Models\Product;
use Modules\User\Models\User;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $brands = Brand::all();
        $users = User::find(1)->get();

        Product::factory()->count(20)->create([
            'user_id' => $users->first()->id,
        ]);

        Product::all()->each(function ($product) use ($categories, $brands) {
            $product->categories()->attach(
                $categories->random(rand(1, 5))->pluck('id')->toArray()
            );
            $product->brand()->associate(
                $brands->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
    }
}
