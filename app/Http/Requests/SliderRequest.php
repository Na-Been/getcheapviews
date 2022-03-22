<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
        $rules = [];
        $rules +=[
            'title'=>'required',
            'sub_title'=>'required',
            'rank'=>'required'
        ];
        if (request()->file('image')) {
            $rules += [
                'image' => 'required',
                'image.*' => 'max:4320|mimes:jpeg,png,jpg,gif,svg,bmp,tif,tiff,eps,webp'
            ];
        }
        return $rules;
    }
}
