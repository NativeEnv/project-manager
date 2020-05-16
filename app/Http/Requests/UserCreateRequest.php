<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    public function messages()
    {
        return [
            'name.required' => 'Необходимо указать имя',
            'name.min' => 'Минимальный размер имени 3 символова',
            'name.max' => 'Максимальный размер имени 3 символова',
            'name.regex' => 'Можно использовать только буквы и цифры',

            'email.required'  => 'Необходимо указать почту',
            'email.email'  => 'Некорректная почта',
            'email.unique'  => 'Почта уже занята',

            'password.required'  => 'Необходимо указать пароль',
            'password.confirmed'  => 'Пароли несовпадают',
            'password.min'  => 'Минимальный размер пароля 8 символова',
            'password.max'  => 'Максимальный размер пароля 255 символова'
        ];
    }

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
            'name' => 'required|min:3|max:30|regex:~\w+~',
            'email' => 'required|email|unique:user',
            'password' => 'required|confirmed|min:8|max:255'
        ];
    }
}
