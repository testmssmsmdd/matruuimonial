<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
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
        return [
            'first_name' => 'required|min:2|max:80',
            'middle_name' => 'nullable|min:1|max:80',
            'last_name' => 'required|min:2|max:80',
            'gender' => 'required',
            'date_of_birth' =>'required',
            'age' => 'required||integer|min:0|max:100',
            'birth_time' => 'nullable',
            'birth_place' => 'required|max:100',
            'height_ft' => 'required',
            'height_in' => 'required',
            'Weight' => 'required|integer|min:5|max:200',
            'marital_status' => 'required',
            'mother_tounge' => 'required|max:100',
            'rashi' => 'required|max:100',
            'caste' => 'required|max:100',
            'manglik' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'current_address' => 'required|max:150',
            'education' => 'required|max:150',
            'occupation' => 'required|max:150',
            'company_name' => 'nullable|max:150',
            'annual_income' => 'nullable|digits_between:1,10',
            'work_location' => 'nullable|max:150',
            'father_name' => 'required|max:150',
            'father_occupation' => 'required|max:150',
            'mother_name' => 'required|max:150',
            'mother_occupation' => 'required|max:150',
            'no_of_brothers' => 'required|integer|min:0|max:12',
            'no_of_sisters' => 'required|integer|min:0|max:12',
            'family_type' => 'required',
            'hobbies' => 'required|max:500',
            'about_me' => 'required|max:800',
            'profile_status' => 'required',
            'created_by' => 'required',
            'profile_completed' => 'nullable',
            'gotra' => 'nullable|max:100',
            'contact_person_name' => 'required|max:200',
            'contact_person_number' => 'required|digits:10',
            'contact_person_wp_number' => 'nullable|digits:10',
            'contact_person_email' => 'nullable|email|max:200',
            'mosal_name' => 'nullable|max:200',
            'birth_hours' => 'required',
            'birth_minutes' => 'required',
            'birth_format' => 'required',
            'location.*' => 'required',
            'mosal' => 'nullable|array',
            'mosal.*.person_name' => 'nullable|string|max:100',
            'mosal.*.contact_number' => 'nullable|digits:10',
            'profile_photo'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_photo.*'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'show_contact_publicly' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'contact_person_name.required' => 'Contact person name is required.',

            'contact_person_number.required' => 'Contact number is required.',
            'contact_person_number.digits' => 'Contact number must be exactly 10 digits.',

            'contact_person_wp_number.digits' => 'WhatsApp number must be exactly 10 digits.',

            'contact_person_email.email' => 'Please enter a valid email address.',
            'gallery_photo.*.image' => 'Please upload valid image files (jpg, jpeg, png).',
            'gallery_photo.*.max' => 'Each gallery photo must not be larger than 2MB.',
            'mosal.*.contact_number.digits' => 'Contact number must be exactly 10 digits.',
            'mosal.*.person_name.max' => 'Person name must be less then 100 words',
        ];
    }
}
