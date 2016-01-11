<?php

namespace Membra\Http\Requests\News;
 
use Illuminate\Foundation\Http\FormRequest;
 
class NewsCategoryCreateRequest extends FormRequest {
	public function rules() {
		return [
			'name' 		=> 'required',
			'slug' 		=> '',
		];
	}
	
	public function authorize() {
		return true;
	}
}