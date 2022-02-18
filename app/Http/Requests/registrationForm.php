<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registrationForm extends FormRequest
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
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'company_email' => 'required|string|email|max:255|unique:users',
            'company_contact' => 'required',
            'password' => 'required',
            'password_hint' => 'required',
            'company_fax' => '',
            'agent_reference_id' => 'required',
            'address' => 'required',
            'agent_country' => 'required',
            'agent_city' => 'required',
            'corporate_reg_no' => '',
            'skype_id' => '',
            'corporate_description' => '',
            'operating_hrs_from' => '',
            'operating_hrs_to' => '',
            'weeks.*' => 'required',
            'agent_certificate_file' => 'required',
            'agent_logo_file' => 'required',
            'agent_opr_currency' => 'required|array',
            'agent_opr_countries' => 'required|array',
            'account_number' => 'required|array',
            'bank_name' => 'required|array',
            'bank_ifsc' => 'required|array',
            'bank_iban' => 'required|array',
            'bank_currency' => 'required|array',
            'service_type' => 'required|array',
            'service_name' => 'array',
            'service_cost' => 'array',
            'contact_person_name' => 'required|array',
            'contact_person_number' => 'required|array',
            'contact_person_email' => 'required|array',
            
        ];
    }
}
