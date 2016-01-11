<?php

namespace LANMS\Http\Requests\News;
 
use Illuminate\Foundation\Http\FormRequest;
 
class NewsCreateRequest extends FormRequest {
	public function rules() {
		return [
			'title' 				=> 'required',
			'content' 				=> 'required',
			'category_id' 			=> 'required|integer',
			'published_at_time' 	=> 'required',
			'published_at_date'		=> 'required',
		];
	}
	
	public function authorize() {
		return true;
	}
}