<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParcelDeliveryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'width'         => 'required|numeric',
            'height'        => 'required|numeric',
            'length'        => 'required|numeric',
            'weight'        => 'required|numeric',
            'name'          => 'required|string',
            'phone_number'  => 'required|string',
            'email'         => 'required|email',
            'address'       => 'required|string',
            'courier'       => 'required|string',
        ];
    }
}
