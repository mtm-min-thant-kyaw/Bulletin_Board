<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules()
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'phone' => 'required|max:15|unique:users,phone,',
            'address' => 'nullable|max:255',
            'dob' => 'nullable|date',
            'profile' => 'required|mimes:jpg,png,jpeg',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name must not exceed 255 characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.max' => 'The email must not exceed 255 characters.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'password_confirmation.required' => 'The password confirmation field is required.',
            'password_confirmation.same' => 'The password confirmation does not match.',
            'phone.required' => 'The phone field is required.',
            'phone.max' => 'The phone must not exceed 15 characters.',
            'phone.unique' => 'The phone has already been taken.',
            'address.max' => 'The address must not exceed 255 characters.',
            'dob.date' => 'The date of birth must be a valid date.',
            'profile.required' => 'Profile field is require.',
            'profile.mimes' => 'Profile must be jpeg,png,jpg type.',
        ];
    }
}
