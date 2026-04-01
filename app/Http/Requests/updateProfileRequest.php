<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class updateProfileRequest extends FormRequest
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
            'first_name' => 'required|min:2',
            'middle_name' => 'nullable|min:1',
            'last_name' => 'required|min:2',
            'gender' => 'required',
            'date_of_birth' =>'required',
            'age' => 'required',
            'birth_time' => 'nullable',
            'birth_place' => 'required',
            // 'height' => 'required',
            'height_ft' => 'required',
            'height_in' => 'required',
            'Weight' => 'required|integer',
            'marital_status' => 'required',
            'mother_tounge' => 'required',
            'rashi' => 'required',
            'caste' => 'required',
            'manglik' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'current_address' => 'required',
            'education' => 'required',
            'occupation' => 'required',
            'company_name' => 'nullable',
            'annual_income' => 'required',
            'work_location' => 'nullable',
            'father_name' => 'required',
            'father_occupation' => 'required',
            'mother_name' => 'required',
            'mother_occupation' => 'required',
            'no_of_brothers' => 'required',
            'no_of_sisters' => 'required',
            'family_type' => 'required',
            'hobbies' => 'required',
            'about_me' => 'required',
            'profile_status' => 'required',
            'created_by' => 'required',
            'profile_completed' => 'nullable',
            'contact_person_name' => 'required',
            'contact_person_number' => 'required',
            'contact_person_wp_number' => 'required',
            'contact_person_email' => 'nullable',
            // 'contact_number[]' => 'required',
            'location.*' => 'required',
            'mosal.*' =>'nullable',
            'mosal_name' => 'nullable',
            'profile_photo'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_photo.*'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'contact_number.*' => 'required'
            // "mosal[*]['name']" =>'required',
            // "mosal[*]['location']" =>'required',
            // "mosal[*]['contact_number']" =>'required',
        ];
    }
}
