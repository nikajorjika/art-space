<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|array',
            'name.*' => 'required|string',
            'description' => 'sometimes|required|array',
            'description.*' => 'required|string',
            'price' => 'sometimes|required|numeric',
            'discount' => 'nullable|numeric|min:0|max:100',
            'quantity' => 'sometimes|required|integer',
            'categories' => 'sometimes|required|array',
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
