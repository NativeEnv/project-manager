<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Project;

class ProjectSettingsRequest extends FormRequest
{
    /**
     * @var array
     */
    private $accessCodes;

    public function messages()
    {
        return [
            'access_type.in_array' => 'Некорректное значение'
        ];
    }

    protected function prepareForValidation()
    {
        $this->accessCodes = Project::getAccessCodes();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'access_type' => 'in:' . implode(',', $this->accessCodes)
        ];
    }
}
