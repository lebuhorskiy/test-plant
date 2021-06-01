<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator; 
use Illuminate\Http\Exceptions\HttpResponseException;
class PlantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'exists:plants,id',
            'title' => 'string|max:255|min:1|required',
            'age' => 'integer|required|max:100',
            'type' => 'required|exists:plant_types,id',
            'products' => 'array',
            'products.*' => 'exists:plant_protection_products,id'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['success' => false, 'error' => $validator->errors()->first()], 322)
        );
    }
}
