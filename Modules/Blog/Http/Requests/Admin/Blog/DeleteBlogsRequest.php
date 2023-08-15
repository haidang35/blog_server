<?php

namespace Modules\Blog\Http\Requests\Admin\Blog;

use Illuminate\Foundation\Http\FormRequest;

class DeleteBlogsRequest extends FormRequest
{
    protected function prepareForValidation()
    {
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ids' => 'required|array',
            'ids.*' => 'required|exists:blogs,uuid',
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
