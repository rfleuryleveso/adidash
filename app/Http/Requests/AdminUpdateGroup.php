<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateGroup extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasAdministrationGroup() || $this->user()->isAdministrator();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'parent_group' => ['nullable', 'exists:App\Models\Group,id'],
            'is_class' => ['nullable', 'in:on'],
            'rank' => ['required', 'in:0,1,2,3,4,5'],
            'auto_expire' => ['required', 'string']
        ];
    }
}
