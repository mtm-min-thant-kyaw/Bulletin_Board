<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
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
            'title' => 'required|max:255',
            'body' => 'required|min:10',
        ];
    }
    public function messages(): array
    {
        return[
            'title.requried' => 'Title is require.',
            'title.max' => 'Maximum limit is 255 characters.',
            'body.required' => 'Body field is required',
            'body.min' => 'Body must have at least 10 characters.'
        ];
    }
}
