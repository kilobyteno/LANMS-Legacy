<?php namespace LANMS\Http\Requests\Member;

use LANMS\Http\Requests\Request;

class ProfileRequest extends Request {

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
			'firstname' 		=> 'required|between:3,250|alpha_dash',
			'lastname' 			=> 'required|between:3,250|alpha_dash',
			'birthdate'			=> 'date_format:Y-m-d',
			'gender' 			=> '',
			'location' 			=> 'regex:/^[A-Za-z ,\']+$/|nullable',
			'occupation' 		=> 'regex:/^[A-Za-z ,\']+$/|nullable',
			'showemail' 		=> 'integer',
			'showname' 			=> 'integer',
			'showonline' 		=> 'integer',
			'userdateformat' 	=> '',
			'usertimeformat' 	=> '',
			'about' 			=> 'nullable',
		];
	}

}
