<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CommentRequest
 * @package App\Http\Requests
 */
class CommentRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'integer',
            'user_id' => 'integer',
            'contentt' => 'string',//contentt used because content is reserved keyword
            'upvote' => 'integer',
            'downvote' => 'integer',
            'parent_id' => 'integer',
        ];
    }
}
