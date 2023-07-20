<?php

namespace Modules\User\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('id')
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|int|exists:users,id',
            'name' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')
                    ->ignore($this->route('id '))
            ],
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|same:password',
            'roles' => 'nullable|array',
            'roles.*' => 'required|string|exists:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'nullable|string|exists:permissions,name'
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
}
