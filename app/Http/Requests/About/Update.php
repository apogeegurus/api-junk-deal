<?php

namespace App\Http\Requests\About;

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
            'title' => 'required|max:100|string',
            'description' => 'required|min:255|string',
            'image' => 'required_without:mainImageUploaded|image|max:4086',
            'alt' => 'nullable|max:20|string',
        ];
    }
}
