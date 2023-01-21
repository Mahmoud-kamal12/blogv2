<?php

namespace App\Http\Requests\pots;

use Illuminate\Foundation\Http\FormRequest;

class updateValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'title' => 'required|unique:posts,title,'. $this->post,
            'description' => 'required',
            'content' => 'required',
        ];
    }
}
