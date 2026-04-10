<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'age' => 'required|integer|min:0|max:100',
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
            // 'profile_status' => 'required',
            'profile_status' => [
                Rule::requiredIf(auth()->user()->role != 'User'),
            ],
            'created_by' => 'required',
            'profile_completed' => 'nullable',
            'gotra' => 'nullable|max:100',
            'contact_person_name' => 'required|max:200',
            'contact_person_number' => [
                Rule::requiredIf(auth()->user()->role !== 'admin'),
                'digits:10',
                Rule::unique('profiles', 'contact_person_number')->ignore($this->user_id, 'user_id')
            ],
            'contact_person_wp_number' => 'nullable|digits:10',
            'contact_person_email' => [
                Rule::requiredIf(auth()->user()->role !== 'Admin'),
                'nullable',
                'email',
                'max:200',
                'unique:profiles,contact_person_email'
            ],
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
            'user_id' => [
                Rule::requiredIf(auth()->user()->role === 'admin'),
                Rule::unique('profiles', 'user_id')->ignore($this->user_id, 'user_id')
            ],
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'first_name.required' => 'First Name is required.',
    //         'first_name.min' => 'First Name is required minimum 2 characters',
    //         'last_name.required' => 'Last Name is required.',
    //         'last_name.min' => 'Last Name is required minimum 2 characters',
    //         'contact_person_name.required' => 'Contact person name is required.',

    //         'contact_person_number.required' => 'Contact number is required.',
    //         'contact_person_number.digits' => 'Contact number must be exactly 10 digits.',

    //         'contact_person_wp_number.digits' => 'WhatsApp number must be exactly 10 digits.',

    //         'contact_person_email.email' => 'Please enter a valid email address.',
    //         'gallery_photo.*.image' => 'Please upload valid image files (jpg, jpeg, png).',
    //         'gallery_photo.*.max' => 'Each gallery photo must not be larger than 2MB.',
    //         'mosal.*.contact_number.digits' => 'Contact number must be exactly 10 digits.',
    //         'mosal.*.person_name.max' => 'Person name must be less then 100 words',
    //     ];
    //  
    
    public function messages(): array
    {
        return [

            // Basic Info
            'first_name.required' => 'First name is required.',
            'first_name.min' => 'First name must be at least 2 characters.',
            'first_name.max' => 'First name may not exceed 80 characters.',

            'middle_name.min' => 'Middle name must be at least 1 character.',
            'middle_name.max' => 'Middle name may not exceed 80 characters.',

            'last_name.required' => 'Last name is required.',
            'last_name.min' => 'Last name must be at least 2 characters.',
            'last_name.max' => 'Last name may not exceed 80 characters.',

            'gender.required' => 'Gender is required.',

            'date_of_birth.required' => 'Date of birth is required.',

            'age.required' => 'Age is required.',
            'age.integer' => 'Age must be a number.',
            'age.min' => 'Age must be at least 0.',
            'age.max' => 'Age must not exceed 100.',

            'birth_place.required' => 'Birth place is required.',
            'birth_place.max' => 'Birth place may not exceed 100 characters.',

            'height_ft.required' => 'Height (feet) is required.',
            'height_in.required' => 'Height (inches) is required.',

            'Weight.required' => 'Weight is required.',
            'Weight.integer' => 'Weight must be a number.',
            'Weight.min' => 'Weight must be at least 5 kg.',
            'Weight.max' => 'Weight must not exceed 200 kg.',

            'marital_status.required' => 'Marital status is required.',

            'mother_tounge.required' => 'Mother tongue is required.',
            'mother_tounge.max' => 'Mother tongue may not exceed 100 characters.',

            'rashi.required' => 'Rashi is required.',
            'rashi.max' => 'Rashi may not exceed 100 characters.',

            'caste.required' => 'Caste is required.',
            'caste.max' => 'Caste may not exceed 100 characters.',

            'manglik.required' => 'Manglik status is required.',

            // Location
            'country_id.required' => 'Country is required.',
            'state_id.required' => 'State is required.',
            'city_id.required' => 'City is required.',

            'current_address.required' => 'Current address is required.',
            'current_address.max' => 'Address may not exceed 150 characters.',

            // Education & Work
            'education.required' => 'Education is required.',
            'education.max' => 'Education may not exceed 150 characters.',

            'occupation.required' => 'Occupation is required.',
            'occupation.max' => 'Occupation may not exceed 150 characters.',

            'company_name.max' => 'Company name may not exceed 150 characters.',

            'annual_income.digits_between' => 'Annual income must be between 1 to 10 digits.',

            'work_location.max' => 'Work location may not exceed 150 characters.',

            // Family
            'father_name.required' => 'Father name is required.',
            'father_name.max' => 'Father name may not exceed 150 characters.',

            'father_occupation.required' => 'Father occupation is required.',
            'father_occupation.max' => 'Father occupation may not exceed 150 characters.',

            'mother_name.required' => 'Mother name is required.',
            'mother_name.max' => 'Mother name may not exceed 150 characters.',

            'mother_occupation.required' => 'Mother occupation is required.',
            'mother_occupation.max' => 'Mother occupation may not exceed 150 characters.',

            'no_of_brothers.required' => 'Number of brothers is required.',
            'no_of_brothers.integer' => 'Must be a number.',
            'no_of_brothers.min' => 'Cannot be negative.',
            'no_of_brothers.max' => 'Cannot exceed 12.',

            'no_of_sisters.required' => 'Number of sisters is required.',
            'no_of_sisters.integer' => 'Must be a number.',
            'no_of_sisters.min' => 'Cannot be negative.',
            'no_of_sisters.max' => 'Cannot exceed 12.',

            'family_type.required' => 'Family type is required.',

            // Personal
            'hobbies.required' => 'Hobbies are required.',
            'hobbies.max' => 'Hobbies may not exceed 500 characters.',

            'about_me.required' => 'About me is required.',
            'about_me.max' => 'About me may not exceed 800 characters.',

            'profile_status.required' => 'Profile status is required.',

            // Contact
            'contact_person_name.required' => 'Contact person name is required.',
            'contact_person_name.max' => 'Contact person name may not exceed 200 characters.',

            'contact_person_number.required' => 'Contact number is required.',
            'contact_person_number.digits' => 'Contact number must be exactly 10 digits.',
            'contact_person_number.unique' => 'This contact number is already used.',

            'contact_person_wp_number.digits' => 'WhatsApp number must be exactly 10 digits.',

            'contact_person_email.required' => 'Email is required.',
            'contact_person_email.email' => 'Enter a valid email address.',
            'contact_person_email.max' => 'Email may not exceed 200 characters.',
            'contact_person_email.unique' => 'This email is already used.',

            // Misc
            'gotra.max' => 'Gotra may not exceed 100 characters.',

            'mosal_name.max' => 'Mosal name may not exceed 200 characters.',

            'birth_hours.required' => 'Birth hour is required.',
            'birth_minutes.required' => 'Birth minutes are required.',
            'birth_format.required' => 'Birth format is required.',

            'location.*.required' => 'Location field is required.',

            // Mosal dynamic
            'mosal.*.person_name.max' => 'Person name must be less than 100 characters.',
            'mosal.*.contact_number.digits' => 'Contact number must be exactly 10 digits.',

            // Images
            'profile_photo.image' => 'Profile photo must be an image.',
            'profile_photo.mimes' => 'Allowed formats: jpeg, png, jpg, gif, svg.',
            'profile_photo.max' => 'Profile photo must not exceed 2MB.',

            'gallery_photo.*.image' => 'Gallery must contain valid images.',
            'gallery_photo.*.mimes' => 'Allowed formats: jpeg, png, jpg, gif, svg.',
            'gallery_photo.*.max' => 'Each image must not exceed 2MB.',

            // User
            'user_id.required' => 'User selection is required.',
            'user_id.unique' => 'This user already has a profile.',

        ];
    }
}
