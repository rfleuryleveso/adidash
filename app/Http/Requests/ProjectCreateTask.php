<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Project;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class ProjectCreateTask extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $project = $this->route('project');
        return $project && $this->user()->can('update', $project);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'description' => 'required|max:8192',
            'tags' => 'sometimes|required|array',
            'parent_task' => ['sometimes', 'required', 'integer', Rule::exists('tasks', 'id')->where(function ($query) {
                $query->where('project_id', $this->route('project')->id);
            })],
            'tags.*' => 'exists:tags,id',
            'start_date' => 'nullable|date_format:d-m-Y',
            'end_date' => 'nullable|date_format:d-m-Y|after:today|after:start_date'
        ];
    }
}
