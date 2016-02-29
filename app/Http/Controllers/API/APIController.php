<?php namespace LANMS\Http\Controllers\API;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;

use LANMS\News;
use LANMS\Checkin;
use LANMS\Visitor;
use LANMS\SeatReservation;

class APIController extends Controller {
	
	public function stats()
	{
		$reserved 		= SeatReservation::all()->count();
		$checkedin 		= Checkin::all()->count();
		$visitors 		= Visitor::all()->count();

		$response = array();
		$response['reserved'] 	= $reserved;
		$response['checkedin'] 	= $checkedin;
		$response['visitors'] 	= $visitors;

		return \Response::json($response);
	}

	public function news($amount)
	{
		$news = News::all()->take($amount);
		return \Response::json($news);
	}

	

}
