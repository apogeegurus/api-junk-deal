<?php

namespace App\Http\Requests\Team;

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
            'name' => 'required|max:50|string',
            'position' => 'required|max:80|string',
            'avatar' => 'required_without:mainImageUploaded|image|max:4086'
        ];
    }
}
