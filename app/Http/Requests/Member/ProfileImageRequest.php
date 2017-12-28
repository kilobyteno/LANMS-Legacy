<?php

namespace LANMS\Http\Requests\Member;
 
use Illuminate\Foundation\Http\FormRequest;
 
class ProfileImageRequest extends FormRequest {
	public function rules() {
		return [
			'profileimage' => 'image|size:8000',
		];
	}
	
	public function authorize() {
		return true;
	}
}