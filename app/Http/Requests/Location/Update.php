<?php

namespace App\Http\Requests\Location;

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
            'city' => 'required|max:100|string',
            'lon' => 'required|max:100|string',
            'lat' => 'required|max:100|string',
            'title' => 'required|max:120|string',
            'sub_title' => 'required|string',
            'facts_left' => 'required|string',
            'facts_right' => 'required|string',
            'description' => 'required|string',

            'website' => 'required|max:120|string|url',
            'city_phone' => 'required|max:120|string',

            'police_address' => 'required|max:120|string',
            'police_phone' => 'required|max:120|string',
            'police_email' => 'required|max:120|string|email',

            'donate_address' => 'required|max:120|string',
            'donate_phone' => 'required|max:120|string',

            'main_image' => 'required_without:mainImageUploaded|image|max:4086',
            'banner_first' => 'required_without:bannerFirstUploaded|image|max:4086',
            'banner_second' => 'required_without:bannerSecondUploaded|image|max:4086',
        ];
    }
}
