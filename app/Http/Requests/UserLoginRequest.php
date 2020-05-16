<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{
    public function messages()
    {
        return [
            'email.required'  => 'Необходимо указать почту',
            'email.email'  => 'Некорректная почта',
            'email.exists'  => 'Некорректные данные',

            'password.required'  => 'Необходимо указать пароль',
            'password.confirmed'  => 'Пароли несовпадают',
            'password.min'  => 'Минимальный размер пароля 8 символова',
            'password.max'  => 'Максимальный размер пароля 255 символова'
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
            'email' => 'required|email|exists:user',
            'password' => 'required|min:8|max:255'
        ];
    }
}
