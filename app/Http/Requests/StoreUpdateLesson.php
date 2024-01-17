<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateLesson extends FormRequest
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
            'module' => ['required', 'exists:modules,uuid'],
            'name' => ['required', 'min:3', 'max:255', 'unique:lessons,name'],
            'video' => ['required', 'min:3', 'max:255', 'unique:lessons,video'],
            'description' => ['required', 'min:3', 'max:9999'],
        ];
    }
}
