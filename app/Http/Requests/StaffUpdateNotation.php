<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StaffUpdateNotation extends FormRequest
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
            'grades' => ['required', 'array'],
            'grades.*.grade' => ['required', Rule::in(['-1', '0', '1', '2'])],
            'grades.*.user' => ['required', 'exists:App\Models\User,id'],
            'grades.*.comments' => ['nullable', 'string'],
            'notation_finished' => ['nullable', 'in:on'],
        ];
    }
}
