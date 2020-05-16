<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectCreateRequest extends FormRequest
{
    public function messages()
    {
        return [
            'title.required' => 'Поле должно быть заполнено',
            'title.min' => 'Минимальная длина поля 3 символова',
            'title.max' => 'Максимальный размер поля 255 символова',
            'title.regex' => 'Можно использовать только буквы и цифры',

            'description.required' => 'Поле должно быть заполнено',
            'description.min' => 'Минимальная длина поля 3 символова',
            'description.max' => 'Максимальный размер поля 255 символова',

            'id_user.exists' => 'Пользователь несуществует'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3|max:255|regex:~\w+~',
            'description' => 'required|min:3|max:255',
            'id_user' => 'exists:user,id'
        ];
    }
}
