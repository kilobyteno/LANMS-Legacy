<?php namespace LANMS\Http\Controllers\API;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;

use LANMS\News;
use LANMS\Checkin;
use LANMS\Visitor;
use LANMS\SeatReservation;
use LANMS\Seats;

class APIController extends Controller {
	
	public function stats()
	{
		$allreserved = SeatReservation::all();

		$i = 0;
		foreach ($allreserved as $reservation) {
			$seat = Seats::find($reservation->seat_id);
			if($seat->row_id <> 1) {
				$i++;
			}
		}

		$reserved		= $i;
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
		$news = News::isPublished()->orderby('published_at', 'desc')->get()->take($amount);
		return \Response::json($news);
	}

	

}
