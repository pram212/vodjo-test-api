<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            "customer_name" => "required|string|max:255",
            "grand_total" => "required|numeric|min:0",
            "items" => [
                "required",
                "array",
            ],
            "items.*.product_name" => [
                "required",
                "string",
                "max:255",
            ],
            "items.*.qty" => [
                "required",
                "integer",
                "min:1",
            ],
            "items.*.price" => [
                "required",
                "numeric",
                "min:10",
            ],
        ];
    }
}
