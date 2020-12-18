<?php

namespace App\Http\Requests\Blog;

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
            'headline' => 'required|max:50|string',
            'sub_headline' => 'required|max:200|string',
            'author' => 'required|max:100|string',
            'description' => 'required|string',
            'mainImage' => 'required_without:mainImageUploaded|image|max:4086',
            'meta_description' => 'required|string',
            'meta_title' => 'required|string',
        ];
    }
}
