<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'phone' => 'required|string',
            'phone_footer' => 'required|string',
            'office_hours' => 'required|string',
            'office_hours_footer' => 'required|string',
            'email' => 'required|string|email',
            'about_footer' => 'required|string',
            'location' => 'required|string',
            'facebook' => 'required|string',
            'youtube' => 'required|string',
            'yelp' => 'required|string',
            'bbb' => 'required|string',
        ];
    }
}
