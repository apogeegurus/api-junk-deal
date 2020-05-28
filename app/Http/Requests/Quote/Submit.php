<?php

namespace App\Http\Requests\Quote;

use Illuminate\Foundation\Http\FormRequest;

class Submit extends FormRequest
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
            'name'  => 'required|string|max:80',
            'email' => 'required|string|max:80|email',
            'phone' => 'required|string|max:80',
            'zip_code' => 'required|string|max:80',
            'date' => 'required|date',
            'description' => 'required|string'
        ];
    }
}
