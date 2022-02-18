<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'menu_name' =>  'required',
            'menu_file' => 'required',
            'has_parent'  =>  'required',
            'menu_pid'  =>  'required_if:has_parent,yes'
        ];
    }

    function prepareForValidation(){
      $this->merge([
        'user_id' =>  auth()->id()
      ]);
    }
}
