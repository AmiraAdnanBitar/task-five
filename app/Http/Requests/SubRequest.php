<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubRequest extends FormRequest
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
            'SubCategory' => 'required|string|max:255|unique:sub_categories,sub_category_name',
            'main' => 'required|string',
    
        ];
    }
}
