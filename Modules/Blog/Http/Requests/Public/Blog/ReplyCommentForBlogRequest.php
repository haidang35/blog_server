<?php

namespace Modules\Blog\Http\Requests\Public\Blog;

use Illuminate\Foundation\Http\FormRequest;

class ReplyCommentForBlogRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => $this->route('slug'),
            'comment_id' => $this->route('commentId'),
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
            'parent_id' => 'required|int|exists:comments,id',
            'comment_id' => 'required|int|exists:comments,id',
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
