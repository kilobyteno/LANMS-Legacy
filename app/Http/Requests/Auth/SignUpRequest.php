<?php

namespace LANMS\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use LANMS\Rules\OlderThan;
use LANMS\Rules\YoungerThan;

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
            'email'             => 'required|email|unique:users,email',
            'firstname'         => 'required|between:3,250|regex:/^[\pL\s\-]+$/u',
            'lastname'          => 'required|between:3,250|regex:/^[\pL\s\-]+$/u',
            'username'          => 'required|unique:users,username',
            'password'          => 'required|confirmed|min:8|max:64',
            'birthdate'         => ['required', 'date_format:Y-m-d', new OlderThan, new YoungerThan],
            'phone'             => 'required|phone:AUTO,NO',
            'tos-pp'            => 'accepted',
        ];
    }
}
