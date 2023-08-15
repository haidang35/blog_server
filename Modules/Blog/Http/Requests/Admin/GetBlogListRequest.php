<?php

namespace Modules\Blog\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Modules\Base\Enums\FilterOperator;

class GetBlogListRequest extends FormRequest
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
            'page' => 'nullable|int|:min:1',
            'filter' => 'nullable|array',
            'filter.*.operator' => [
                'required',
                new Enum(FilterOperator::class)
            ],
            'filter.*.value' => 'nullable|string',
            'filter.*.column' => 'required|string|in:id,title',
            'sort' => 'nullable|array',
            'sort.*.column' => 'required|string|in:id,title,created_at',
            'sort.*.type' => 'required|string|in:asc,desc,ASC,DESC'
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
