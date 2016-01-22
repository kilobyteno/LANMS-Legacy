<?php

namespace LANMS\Http\Requests\Page;
 
use Illuminate\Foundation\Http\FormRequest;
 
class PageEditRequest extends FormRequest {
	public function rules() {
		return [
			'title' 				=> 'required|alpha',
			'content' 				=> 'required',
			'slug' 					=> 'required|alpha_dash',
		];
	}
	
	public function authorize() {
		return true;
	}
}