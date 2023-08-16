<?php

namespace Modules\Blog\Http\Requests\Admin\BlogCategory;

use App\Rules\ExistsIfEqualsZero;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBlogCategoryRequest extends FormRequest
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
            'id' => 'required|int|exists:blog_categories,id',
            'parent_id' => [
                'nullable',
                'int',
                new ExistsIfEqualsZero('blog_categories', 'id')
            ],
            'name' => 'required|string',
            'description' => 'nullable|string',
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
