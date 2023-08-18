<?php

namespace Modules\Blog\Http\Requests\Admin\Blog;

use Illuminate\Foundation\Http\FormRequest;

class CreateBlogRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'content' => 'required|string',
            'files' => 'nullable|array',
            'files.*' => 'required|int|exists:media,id',
            'categories' => 'nullable|array',
            'categories.*' => 'nullable|int|exists:blog_categories,id',
            'seo_meta' => 'nullable|array',
            'seo_meta.title' => 'nullable|string',
            'seo_meta.description' => 'nullable|string',
            'seo_meta.keywords' => 'nullable|array',
            'seo_meta.robots' => 'nullable|array',
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
