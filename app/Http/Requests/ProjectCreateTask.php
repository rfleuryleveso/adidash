<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
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
            'status' => 'sometimes|required|in:STARTED,WAITING,FINISHED,CANCELLED',
            'parent_task' => ['sometimes', 'required', 'integer', Rule::exists('tasks', 'id')->where(function ($query) {
                $query->where('project_id', $this->route('project')->id);
            })],
            'tags.*' => 'exists:tags,id',
            'starts_at' => 'nullable|date_format:d-m-Y',
            'ends_at' => 'nullable|date_format:d-m-Y|after:today|after:starts_at'
        ];
    }
}
