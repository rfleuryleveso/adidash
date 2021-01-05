<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectAdminSearchTasks extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Honestly, this check is pointless.
        $project = $this->route('project');
        return $project && $this->user()->can('view', $project);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'status' => ['sometimes', 'required', 'array'],
            'status.*' => [
                'required',
                Rule::in(['WAITING_FOR_PARENT_TASK', 'WAITING', 'STARTED', 'FINISHED', 'CANCELLED'])
            ]
        ];
    }
}
