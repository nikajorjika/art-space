<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|array',
            'name.*' => 'required|string',
            'slug' => 'required|array',
            'slug.*' => 'required|string',
            'description' => 'required|array',
            'description.*' => 'required|string',
            'price' => 'required|numeric',
            'discount' => 'numeric|min:0|max:100',
            'quantity' => 'required|integer',
            'categories' => 'required|array',
            'categories.*' => 'integer|exists:categories,id',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
