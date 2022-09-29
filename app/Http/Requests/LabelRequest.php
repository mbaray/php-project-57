<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:labels',
            'description' => 'nullable'
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => __('messages.label.unique'),
        ];
    }
}
