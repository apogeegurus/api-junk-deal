<?php

namespace App\Http\Requests\Service;

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
            'title' => 'required|max:50|string',
            'sub_title' => 'required|max:80|string',
            'short_description' => 'required|min:60|max:500|string',
            'long_description' => 'required|min:255|string',
            //needs to delete
//            'gallery' => 'required|array',
//            'gallery.*' => 'required|image|max:4086',
            'mainImage' => 'required|image|max:4086',
            'alt' => 'max:20|string',
            'meta_description' => 'required|string',
            'meta_title' => 'required|string',
        ];
    }
}
