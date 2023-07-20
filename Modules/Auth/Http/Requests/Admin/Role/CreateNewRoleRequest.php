<?php

namespace Modules\Auth\Http\Requests\Admin\Role;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewRoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array(
            'name' => 'required|string|unique:roles,name'
        );
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
