<?php

namespace LANMS\Http\Requests\Admin\Sponsor;

use Illuminate\Foundation\Http\FormRequest;

class SponsorEditRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'          => 'required',
            'url'           => '',
            'description'   => '',
            'sort_order'    => 'required|integer',
            'image'         => 'image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
    
    public function authorize()
    {
        return true;
    }
}
