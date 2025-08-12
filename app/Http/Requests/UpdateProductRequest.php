<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string|max:1000',
            'price'         => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'         => 'The product name is required.',
            'name.string'           => 'The product name must be a string.',
            'name.max'              => 'The product name may not be greater than 255 characters.',
            'description.string'    => 'The description must be a string.',
            'description.max'       => 'The description may not be greater than 1000 characters.',
            'price.required'        => 'The price is required.',
            'price.numeric'         => 'The price must be a number.',
            'price.min'             => 'The price must be at least 0.',
        ];
    }
}
