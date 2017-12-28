<?php

namespace LANMS\Http\Requests\Member;
 
use Illuminate\Foundation\Http\FormRequest;
 
class ProfileCoverRequest extends FormRequest {
	public function rules() {
		return [
			'profilecover' 		=> 'image|size:8000',
		];
	}
	
	public function authorize() {
		return true;
	}
}