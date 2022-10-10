<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TagRequest
 * @package App\Http\Requests
 */
class TagRequest extends FormRequest
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
            'name' => 'string'
        ];
    }
}
