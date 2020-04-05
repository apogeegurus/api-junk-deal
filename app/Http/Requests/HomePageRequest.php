<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomePageRequest extends FormRequest
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
            'title' => 'required',
            'sub_title' => 'required',
            'specialize_title' => 'required',
            'banner_one_text' => 'required',
            'banner_two_text' => 'required',
            'how_it_works_title' => 'required',
            'how_it_works_sub_title' => 'required',
            'step_1_text' => 'required',
            'step_2_text' => 'required',
            'step_3_text' => 'required',
            'video_title' => 'required'
        ];
    }
}
