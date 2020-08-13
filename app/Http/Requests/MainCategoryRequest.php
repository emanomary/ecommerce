<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryRequest extends FormRequest
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
            //validate on add and create
            'photo' => 'required_without:id|mimes:jpg,jpeg,png',
            'category' => 'required_without|array|min:1',
            //to input all the field of array name,abbr,active
            'category.*.name' => 'required',
            'category.*.abbr' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'mimes' => 'هذا الحقل مطلوب',
        ];
    }
}
