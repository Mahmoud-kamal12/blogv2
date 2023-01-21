<?php

namespace App\Http\Requests\categories;

use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Http\Request;
// use Illuminate\Validation\Rule;

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

            // 'name' => "required|unique:<Table_Name>,<column_to_check>," . $this-> <Model_Name> ->id,
            'name' => "required|unique:categories,name," . $this->category->id,
        ];
    }
}
