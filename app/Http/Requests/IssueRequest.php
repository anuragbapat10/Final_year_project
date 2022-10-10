<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class IssueRequest
 * @package App\Http\Requests
 */
class IssueRequest extends FormRequest
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
            'author_id' => 'required|integer',
            'desc_comment_id' => 'required|integer',
            'assignee_id' => 'required|integer',
            'status_id' => 'required|integer',
            'tags' => 'required|integer',
        ];
    }
}
