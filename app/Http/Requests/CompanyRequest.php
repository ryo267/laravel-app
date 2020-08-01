<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyRequest extends FormRequest
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
            //
            'screen_name' => ['required', 'string', 'max:255', Rule::unique('companies')->ignore($this->company)],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('companies')->ignore($this->company)],
        ];
    }

    public function messages()
   {
       return [
           'screen_name.required' => ':attributeは入力必須です。',
           'screen_name.max' => ':attributeは255文字以内で入力してください',
           'screen_name.unique' => ':attributeは既に入力されています',
           'name.required' => ':attributeは入力必須です。',
           'name.max' => ':attributeは255文字以内で入力してください',
           'name.unique' => ':attributeは既に入力されています',
           'email.required' => ':attributeは入力必須です。',
           'email.max' => ':attributeは255文字以内で入力してください',
           'email.unique' => ':attributeは既に入力されています',
       ];
   }
}
