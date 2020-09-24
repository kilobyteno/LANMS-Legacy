<?php

namespace LANMS\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use LANMS\Rules\OlderThan;
use LANMS\Rules\YoungerThan;

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
            'gender'            => '',
            'location'          => 'regex:/^[A-Za-z ,\']+$/|nullable',
            'occupation'        => 'regex:/^[A-Za-z ,\']+$/|nullable',
            'birthdate'         => ['required', 'date_format:Y-m-d', new OlderThan, new YoungerThan],
            'phone'             => 'required|phone:AUTO,NO',
            'showname'          => 'integer',
            'showemail'         => 'integer',
            'showonline'        => 'integer',
            'language'          => '',
            'theme'             => '',
            'about'             => 'nullable',
        ];
    }
}
