<?php

namespace LANMS\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
            'email'             => 'required|email',
            'firstname'         => 'required|between:3,250|alpha_dash',
            'lastname'          => 'required|between:3,250|alpha_dash',
            'username'          => 'required',
            'password'          => 'required|confirmed|min:8|max:64',
            'birthdate'         => 'required|date_format:d/m/Y',
            'phone'             => 'required|phone:AUTO,NO',
            'tos-pp'            => 'accepted',
        ];
    }
}
