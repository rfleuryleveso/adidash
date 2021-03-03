<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommitteeCreateTag extends FormRequest
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
            'name' => 'required|string|min:3',
            'color' => ['required', Rule::in(['is-black', 'is-dark', 'is-light', 'is-white', 'is-primary', 'is-link', 'is-info', 'is-success', 'is-warning', 'is-danger'])],
            'icon' => ['nullable', 'regex:/fa. fa-[a-z]+/']
        ];
    }
}
