<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StaffSearchTasks extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['sometimes', 'nullable', 'string', 'max:255'],
            'status' => ['sometimes', 'required', 'array'],
            'status.*' => [
                'required',
                Rule::in(['WAITING_FOR_PARENT_TASK', 'WAITING', 'STARTED', 'FINISHED', 'CANCELLED'])
            ],
            'notation_status' => ['sometimes', 'required', 'array'],
            'notation_status.*' => [
                'required',
                Rule::in(['WAITING_FOR_CHIEF', 'WAITING_FOR_STAFF', 'FINISHED'])
            ],
            'projects' => ['sometimes', 'required', 'array'],
            'projects.*' => ['required', 'exists:App\Models\Project,id']
        ];
    }
}
