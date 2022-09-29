<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TaskStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
//        return Auth::user();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:task_statuses',
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => __('messages.task_status.unique'),
        ];
    }
}
