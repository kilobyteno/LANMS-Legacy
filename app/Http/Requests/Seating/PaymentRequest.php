<?php namespace LANMS\Http\Requests\Seating;

use LANMS\Http\Requests\Request;

class PaymentRequest extends Request {

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
			'cardNumber' 		=> 'required|numeric|digits_between:12,16',
			'cardMonthExpiry' 	=> 'required|numeric|digits:2|min:1|max:12',
			'cardYearExpiry' 	=> 'required|numeric|digits:2|min:16|max:40',
			'cardCVC' 			=> 'required|numeric|digits:3',
		];
	}

}
