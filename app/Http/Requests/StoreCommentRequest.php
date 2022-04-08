<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Gate;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('comment_create'),403);
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content'      =>['string','required'],
            'task_id'      =>['required','exists:tasks,id'],
            'user_id'      =>['required','exists:users,id'],
            'comment_id'   =>['nullable','exists:comments,id'],
        ];
    }
}
