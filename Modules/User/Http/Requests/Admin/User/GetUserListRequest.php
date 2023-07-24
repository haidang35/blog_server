<?php

namespace Modules\User\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class GetUserListRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'limit' => 'nullable|int|:min:0|max:25',
            'page' => 'nullable|int|:min:1'
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
