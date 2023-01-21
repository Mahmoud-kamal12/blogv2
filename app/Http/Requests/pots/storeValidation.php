<?php

namespace App\Http\Requests\pots;

use Illuminate\Foundation\Http\FormRequest;

class storeValidation extends FormRequest
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
            'title' => 'required|unique:posts,title',
            'description' => 'required',
            'content' => 'required|min:20',
            'image' => 'required|image|mimes:png,jpg,webp|max:2000',
            'category_id' => 'required|exists:categories,id',
            // 'tagID' => 'required|exists:tags,id'
        ];
    }
}
