<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentUpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request. bite
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
            'old_password' => 'password',
            'password' =>  'confirmed'
        ];
    }
}
