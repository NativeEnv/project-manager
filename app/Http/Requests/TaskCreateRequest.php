<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3|max:30|regex:~\w+~',
            'description' => 'required|min:3|max:30|regex:~\w+~',
            'price' => 'required',
            'deadline' => 'required'
        ];
    }
}
