<?php

namespace Modules\Blog\Http\Requests\Public\Blog;

use Illuminate\Foundation\Http\FormRequest;

class AddCommentForBlogRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => $this->route('slug')
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
            'name' => 'required|string',
            'email' => 'required|email',
            'content' => 'required|string',
            'website' => 'nullable|string',
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
