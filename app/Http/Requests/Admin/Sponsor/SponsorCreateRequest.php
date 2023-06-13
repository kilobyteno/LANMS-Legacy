<?php

namespace LANMS\Http\Requests\Admin\Sponsor;

use Illuminate\Foundation\Http\FormRequest;

class SponsorCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'          => 'required',
            'url'           => 'max:255|nullable',
            'description'   => 'max:255|nullable',
            'sort_order'    => 'required|integer',
            'image_light'   => 'required|image|mimes:jpeg,png,jpg,gif',
            'image_dark'    => 'required|image|mimes:jpeg,png,jpg,gif',
        ];
    }
    
    public function authorize()
    {
        return true;
    }
}
