<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
        if ($this->isMethod('put')) {
          return [
              'users_empcode' => 'required',
              'users_role' =>  'required',
              'users_partner_country' =>  'required_if:user_role,partner',
              'username'  =>  'sometimes|required|unique:users,username,'.$this->user,
              'users_fname'  =>  'required',
              'users_lname' => 'required',
              'users_contact'  => 'required',
              'email'  => 'sometimes|required|unique:users,email,'.$this->user,
              'name'  =>  'required'
          ];
        }
        return [
            'users_empcode' => 'required',
            'users_role' =>  'required',
            'users_partner_country' =>  'required_if:user_role,partner',
            'username'  =>  'required|unique:users',
            'users_fname'  =>  'required',
            'users_lname' => 'required',
            'users_contact'  => 'required',
            'email'  => 'required|unique:users',
            'name'  =>  'required'
        ];
    }

    public function prepareForValidation(){
      $this->merge([
        'password' => null,
        'users_password_hint' => null,
        'name' =>  $this->users_fname .' '. $this->users_lname
      ]);
    }
}
