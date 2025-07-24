<?php

namespace App\Http\Requests;

use App\Rules\ProductHasPrice;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClientRequest extends FormRequest
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
         $clientId = $this->route('client')?->id ?? null;
        return [
            'name' => 'required|string|max:255',
            'matricule_fiscale' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => [
            'required',
            'email',
            Rule::unique('clients', 'email')->ignore($clientId),
        ],

            'product_ids' => [
                'required',
                'array',
                new ProductHasPrice(
                    $this->input('product_ids', []),
                    $this->input('prices', [])
                ),
            ],
            'product_ids.*' => 'exists:products,id',
            'prices' => 'array',
        ];
    }
}
