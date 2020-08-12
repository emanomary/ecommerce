<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
            'name' => 'required|max:100|string',
            'abbr' => 'required|max:10|string',
            'direction' => 'required|in:rtl,ltr',
            //'active' => 'required|in:1',

        ];
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'name.max' => 'يجب ألا يزيد طول الاسم عن 100 حرف',
            'name.string' => 'يجب أن يكون اسم اللغة عبارة عن حروف',
            'abbr.max' => 'يجب ألا يزيد طول الاختصار عن 10 أحرف',
            'abbr.string' => 'يجب أن يكون الاختصار عبارة عن حروف',
            'in' => 'القيمة المدخلة غير صحيحة',

        ];
    }

}
