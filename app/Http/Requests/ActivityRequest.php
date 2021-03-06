<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
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
            'name' => 'required',
            'location' => 'required',
            'country_id' => 'required|numeric',
            'city_id' => 'required',
            'duration' => 'required',
            'valid_from' => "date|required",
            'valid_to' => 'date|required|gte:valid_from',
            'time_from' => 'required',
            'time_to' => 'required',
            'currency' => 'numeric|required',
            'booking_type' => 'required',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
