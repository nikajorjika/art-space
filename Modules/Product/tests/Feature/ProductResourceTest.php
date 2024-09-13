<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Product\Models\Brand;
use Modules\Product\Models\Category;
use Modules\Product\Models\Product;
use Modules\User\Models\User;

uses(Tests\TestCase::class);
uses(RefreshDatabase::class);

describe('Product Resource CRUD', function () {
    // Test if the user can view the product index page
    it('can get the products on index page', function () {
        $user = User::factory()->create();
        Product::factory()->count(20)->create([
            'user_id' => $user->id
        ]);
        $response = $this->getJson(route('api.product.index'));
        $response->assertStatus(200);
        $response->assertJsonCount(10, 'data');
    });

    it('can get the custom paginated products on index page', function () {
        $user = User::factory()->create();
        Product::factory()->count(20)->create([
            'user_id' => $user->id
        ]);
        $response = $this->getJson(route('api.product.index', ['pagination' => 5]));
        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data');
    });


    it('can get paginated data correctly', function () {
        $user = User::factory()->create();

        // Create 20 products associated with the user
        Product::factory()->count(20)->create([
            'user_id' => $user->id
        ]);

        // Fetch the first page of products
        $responsePage1 = $this->getJson(route('api.product.index', ['page' => 1]));

        // Fetch the second page of products
        $responsePage2 = $this->getJson(route('api.product.index', ['page' => 2]));

        // Assert that both responses are successful
        $responsePage1->assertStatus(200);
        $responsePage2->assertStatus(200);

        // Decode JSON responses to get the data arrays
        $dataPage1 = $responsePage1->json('data');
        $dataPage2 = $responsePage2->json('data');

        // Assert that the data arrays are not empty
        expect($dataPage1)->not->toBeEmpty();
        expect($dataPage2)->not->toBeEmpty();

        // Assert that the data on page 1 is not the same as on page 2
        expect($dataPage1)->not->toEqual($dataPage2);
        // Optionally, assert that the product IDs on both pages are different
        $idsPage1 = array_column($dataPage1, 'id');
        $idsPage2 = array_column($dataPage2, 'id');

        expect(array_intersect($idsPage1, $idsPage2))->toBeEmpty();

        // Assert that the total number of products is 20
        $total = $responsePage1->json('total');
        expect($total)->toBe(20);

        // Assert that the pagination links are present
        $responsePage1->assertJsonStructure([
            'data',
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'links',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total',
        ]);

    });

    it('can get the product details', function () {
        $user = User::factory()->create();
        $product = Product::factory()->create([
            'user_id' => $user->id
        ]);
        $response = $this->getJson(route('api.product.show', $product->id));
        $response->assertStatus(200);
        $response->assertJson([
            'id' => $product->id,
            'name' => $product->getOriginal('name'),
            'description' => $product->getOriginal('description'),
            'price' => $product->price,
            'user_id' => $user->id,
        ]);
    });

    it('can create a product', function () {
        $user = User::factory()->create();
        $product = Product::factory()->make();
        $categories = Category::factory()->count(3)->create();
        $postData = array_merge($product->toArray(),
            ['categories' => $categories->pluck('id')->toArray(), 'quantity' => 10]);

        $response = $this->actingAs($user)->postJson(route('api.product.store'), $postData);
        $response->assertStatus(201);
        $response->assertJson([
            'name' => $product->getTranslations('name'),
            'description' => $product->getTranslations('description'),
            'price' => $product->price,
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('products', [
            'id' => $response->json('id'),
            'sku' => $response->json('sku'),
        ]);

        $this->assertDatabaseHas('category_product', [
            'product_id' => $response->json('id'),
            'category_id' => $categories->first()->id,
        ]);
    });
});
