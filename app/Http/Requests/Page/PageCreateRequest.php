<?php

namespace LANMS\Http\Requests\Page;
 
use Illuminate\Foundation\Http\FormRequest;
 
class PageCreateRequest extends FormRequest {
	public function rules() {
		return [
			'title' 				=> 'required|alpha_dash',
			'content' 				=> 'required',
			'slug' 					=> 'required|alpha',
		];
	}
	
	public function authorize() {
		return true;
	}
}