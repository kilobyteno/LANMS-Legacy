<?php namespace LANMS\Http\Requests\Member;

use LANMS\Http\Requests\Request;

class ChangeUserDetailsRequest extends Request {

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
			'email' 		=> 'required|max:50|email|unique:users',
			'firstname' 	=> 'required|min:3|max:250|regex:/^[A-Za-z0-9\-! ,\'\"\/@\.:\(\)]+$/',
			'lastname' 		=> 'required|min:3|max:250|regex:/^[A-Za-z0-9\-! ,\'\"\/@\.:\(\)]+$/',
			'gender' 		=> '',
			'location' 		=> '',
			'occupation' 	=> '',
		];
	}

}
