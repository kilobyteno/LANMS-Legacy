<?php

namespace LANMS\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            'firstname'         => 'required|between:3,250|string',
            'lastname'          => 'required|between:3,250|string',
            'username'          => 'required|between:3,250|unique:users,username,'.$this->id.',id',
            'email'             => 'required|max:50|email|unique:users,email,'.$this->id.',id',
            'birthdate'         => 'date_format:Y-m-d',
            'gender'            => '',
            'location'          => 'regex:/^[A-Za-z ,\']+$/|nullable',
            'occupation'        => 'regex:/^[A-Za-z ,\']+$/|nullable',
            'showemail'         => 'integer',
            'showname'          => 'integer',
            'showonline'        => 'integer',
            'userdateformat'    => '',
            'usertimeformat'    => '',
        ];
    }
}
