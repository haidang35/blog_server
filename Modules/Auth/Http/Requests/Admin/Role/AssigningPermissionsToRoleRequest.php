<?php

namespace Modules\Auth\Http\Requests\Admin\Role;

use Illuminate\Foundation\Http\FormRequest;

class AssigningPermissionsToRoleRequest extends FormRequest
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
            'id' => 'required|int|exists:roles,id',
            'permissions' => 'required|array',
            'permissions.*' => 'required|string|exists:permissions,name'
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
