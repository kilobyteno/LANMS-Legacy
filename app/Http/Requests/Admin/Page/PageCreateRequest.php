<?php

namespace LANMS\Http\Requests\Admin\Page;
 
use Illuminate\Foundation\Http\FormRequest;
 
class PageCreateRequest extends FormRequest {
	public function rules() {
		return [
			'title' 				=> 'required',
			'content' 				=> 'required',
		];
	}
	
	public function authorize() {
		return true;
	}
}