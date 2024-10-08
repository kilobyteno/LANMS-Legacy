<?php

namespace LANMS\Http\Requests\Member;

use LANMS\Http\Requests\Request;
use LANMS\Rules\OlderThan;
use LANMS\Rules\YoungerThan;

class ProfileRequest extends Request
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
            'firstname'         => 'required|between:3,250|regex:/^[\pL\s\-]+$/u',
            'lastname'          => 'required|between:3,250|regex:/^[\pL\s\-]+$/u',
            'birthdate'         => ['required', 'date_format:Y-m-d', new OlderThan, new YoungerThan],
            'phone'             => 'required|phone:LENIENT,NO',
            'phone_country'     => 'required_with:phone',
            'gender'            => '',
            'location'          => 'regex:/^[A-Za-z ,\']+$/|nullable',
            'occupation'        => 'regex:/^[A-Za-z ,\']+$/|nullable',
            'showemail'         => 'integer',
            'showname'          => 'integer',
            'showonline'        => 'integer',
            'language'          => '',
            'theme'             => '',
            'about'             => 'nullable',
            'clothing_size' => 'nullable',
            'address_street' => 'nullable|regex:/^((.){1,}(\d){1,}(.){0,})$/|max:150',
            'address_postalcode' => 'nullable|alpha_dash|min:4',
            'address_city' => 'nullable|regex:/^[A-Za-z \Wæøå]+$/',
            'address_county' => 'nullable|regex:/^[A-Za-z \Wæøå]+$/',
            'address_country' => 'nullable|alpha',
        ];
    }
}
