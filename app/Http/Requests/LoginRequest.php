<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        
                'email' => 'required|string|max:255',
                'password' => 'required|string|max:255',
        
        ];
    }
    public function meesage(): array
    {
        return [
            'email.required'=>'email is required',
            'password.required'=>'password is required',
            'email.string'=>'email is string',
            'password.string'=>'password is string',
            'email.max'=>'email is max 255',
            'password.max'=>'password is max 255',
        ];
    }
}
