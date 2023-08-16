<?php

namespace Modules\Blog\Http\Requests\Admin\BlogCategory;

use Illuminate\Foundation\Http\FormRequest;

class DeleteBlogCategoriesRequest extends FormRequest
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
            'ids.*' => 'required|exists:blog_categories,id',
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
