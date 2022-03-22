<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChangePassword extends FormRequest
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
        Validator::extend('current_password_check', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, current($parameters));
        });
        $rules = [
            'current_password' => 'required|current_password_check:' . Auth::user()->password,
            'new_password' => 'required|min:8|different:current_password',
            'confirm_password' => 'required|same:new_password'
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'current_password_check' => 'The :attribute does not match'
//           ' current_password.'=>'dssasasa'
//        'current_password.required'=>'dsaasa',
//        'current_password.current_password_check'=>'old password doesnot '

        ];
    }
}
