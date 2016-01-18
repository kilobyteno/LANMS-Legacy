<?php namespace LANMS\Http\Requests\Member;

use LANMS\Http\Requests\Request;

class AddressCreateRequest extends Request {

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
			'address1' 		=> 'required',
			'postalcode' 	=> 'required',
			'city' 			=> 'required',
			'county' 		=> 'required',
			'country' 		=> 'required',
		];
	}

}
