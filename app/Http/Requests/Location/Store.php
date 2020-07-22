<?php

namespace App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'what_to_eat' => 'required|string',
            'where_to_go' => 'required|string',
            'description' => 'required|string',
            'url' => 'nullable|unique:locations,url',

            'website' => 'required|max:120|string|url',
            'city_phone' => 'required|max:120|string',

            'address' => 'required',
            'population' => 'required|max:120|string',
            'average_age' => 'required|max:120|string',
            'median_income' => 'required|max:120|string',
            'median_home_value' => 'required|max:120|string',
            'wiki_link' => 'required|url',

            'city_emblem' => 'required|image|max:4086',
            'main_image' => 'required|image|max:4086',
            'banner_first' => 'required|image|max:4086',
            'banner_second' => 'required|image|max:4086',
        ];
    }
}
