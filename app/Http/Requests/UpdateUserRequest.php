<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    
    public function rules(): array
    {
        $userId = $this->route('id'); 

        return [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'middle_name' => 'nullable',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($userId)
            ],
            'phone_number' => [
                'required',
                'numeric',
                Rule::unique('users')->ignore($userId)
            ],
            'password'=>'sometimes|nullable|confirmed'
        ];
    }
}
