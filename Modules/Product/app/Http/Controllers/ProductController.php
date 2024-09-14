<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Product\Http\Requests\CreateProductRequest;
use Modules\Product\Http\Requests\UpdateProductRequest;
use Modules\Product\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pagination = $request->get('pagination', 10);
        $products = Product::paginate($pagination);

        return response()->json($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request): JsonResponse
    {
        $generatedSKU = Str::uuid();
        $categories = $request->get('categories');
        $quantity = $request->get('quantity');;
        $productFields = array_merge(
            $request->only([
                'slug',
                'name',
                'description',
                'price',
                'discount',
                'stock_quantity',
                'brand_id',
            ]),
            ['sku' => $generatedSKU]
        );
        $product = $request->user()->products()->create($productFields);
        $product->categories()->attach($categories);

        // TODO: Need to add the quantity to the stock
        return response()->json($product, 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $productFields = $request->only([
            'name',
            'description',
            'price',
            'discount',
            'stock_quantity',
            'brand_id',
        ]);
        $categories = $request->get('categories');

        $product->update($productFields);

        if ($categories) {
            $product->categories()->sync($categories);
        }

        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully.'], 200);
    }
}
