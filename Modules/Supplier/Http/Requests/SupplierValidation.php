<?php

namespace Modules\Supplier\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierValidation extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'company_contact' => 'required',
            'password' => 'required',
            'password_hint' => 'required',
            'company_fax' => '',
            'address' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'corporate_reg_no' => '',
            'skype_id' => '',
            'corporate_desc' => '',
            'operating_hrs_from' => '',
            'operating_hrs_to' => '',
            'operating_weekdays' => 'required',
            'operating_weekdays.*' => 'required',
            'supplier_certificate_corp' => 'required',
            'supplier_logo' => 'required',
            'opr_currency' => 'required|array',
            'opr_countries' => 'required|array',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [

        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
