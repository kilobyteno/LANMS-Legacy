<?php namespace LANMS\Http\Controllers\API;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;

use LANMS\News;
use LANMS\Checkin;
use LANMS\Visitor;
use LANMS\SeatReservation;
use LANMS\Seats;
use LANMS\User;

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

		$appnews = array();

		foreach ($news as $key) {
			$id 		= $key["id"];
			$slug 		= $key["slug"];
			$title 		= $key["title"];
			$content 	= html_entity_decode(strip_tags($key["content"], '<br>'));
			$content    = preg_replace('/<br(\s+)?\/?>/i', "\n", $content);
			$content	= (strlen($content) > 1000 ? substr($content, 0, 1000).'...' : $content);
			$summary	= (strlen($content) > 300 ? substr($content, 0, 300).'...' : $content);
			$author		= User::getFullnameAndNicknameByID($key["author_id"]);
			$portrait	= (User::getImageLocation($key["author_id"]) ? \Setting::get('WEB_PROTOCOL').'://'.\Setting::get('WEB_DOMAIN').(\Setting::get('WEB_PORT') <> 80 ? ':'.\Setting::get('WEB_PORT') : '').User::getImageLocation($key["author_id"]) : '');
			$image 		= ($key["image"] ? \Setting::get('WEB_PROTOCOL').'://'.\Setting::get('WEB_DOMAIN').(\Setting::get('WEB_PORT') <> 80 ? ':'.\Setting::get('WEB_PORT') : '').$key["image"] : 'https://downlinkdg.no/images/lan.jpg');
			
			/*$published_at 		= ($key["published_at"] <> "0000-00-00 00:00:00" ? $key["published_at"] : $key["created_at"]);*/
			$published_at_human = \Carbon::now()->createFromTimestamp(strtotime($key["published_at"]))->diffForHumans();
			$editor				= User::getFullnameAndNicknameByID($key["editor_id"]);
			$published_at 		= $key["published_at"];
			$created_at 		= $key["created_at"];
			$updated_at 		= $key["updated_at"];

			$article = array('id' => $id, 'slug' => $slug, 'title' => $title, 'summary' => $summary, 'content' => $content, 'author' => $author, 'portrait' => $portrait, 'image' => 'https://downlinkdg.no/images/lan.jpg', 'created_at' => $created_at, 'published_at' => $published_at, 'published_at_human' => $published_at_human, 'editor' => $editor, 'updated_at' => $updated_at, 'likes' => 0, 'comments' => 0);

			array_push($appnews, $article);
			// Her må jeg hente ut det jeg trenger og legge inn i en ny array så dataen er klar for app. Altså full url, forfatter, content osv.
		}
		return \Response::json(array('entries' => $appnews));
	}

	public function skipNews($amount, $skip)
	{
		$news = News::isPublished()->orderby('published_at', 'desc')->take($amount)->skip($skip)->get();

		$appnews = array();

		foreach ($news as $key) {
			$id 		= $key["id"];
			$slug 		= $key["slug"];
			$title 		= $key["title"];
			$content 	= html_entity_decode(strip_tags($key["content"], '<br>'));
			$content    = preg_replace('/<br(\s+)?\/?>/i', "\n", $content);
			$content	= (strlen($content) > 1000 ? substr($content, 0, 1000).'...' : $content);
			$summary	= (strlen($content) > 300 ? substr($content, 0, 300).'...' : $content);
			$author		= User::getFullnameAndNicknameByID($key["author_id"]);
			$portrait	= (User::getImageLocation($key["author_id"]) ? \Setting::get('WEB_PROTOCOL').'://'.\Setting::get('WEB_DOMAIN').(\Setting::get('WEB_PORT') <> 80 ? ':'.\Setting::get('WEB_PORT') : '').User::getImageLocation($key["author_id"]) : '');
			$image 		= ($key["image"] ? \Setting::get('WEB_PROTOCOL').'://'.\Setting::get('WEB_DOMAIN').(\Setting::get('WEB_PORT') <> 80 ? ':'.\Setting::get('WEB_PORT') : '').$key["image"] : 'https://downlinkdg.no/images/lan.jpg');
			
			/*$published_at 		= ($key["published_at"] <> "0000-00-00 00:00:00" ? $key["published_at"] : $key["created_at"]);*/
			$published_at_human = \Carbon::now()->createFromTimestamp(strtotime($key["published_at"]))->diffForHumans();
			$editor				= User::getFullnameAndNicknameByID($key["editor_id"]);
			$published_at 		= $key["published_at"];
			$created_at 		= $key["created_at"];
			$updated_at 		= $key["updated_at"];

			$article = array('id' => $id, 'slug' => $slug, 'title' => $title, 'summary' => $summary, 'content' => $content, 'author' => $author, 'portrait' => $portrait, 'image' => 'https://downlinkdg.no/images/lan.jpg', 'created_at' => $created_at, 'published_at' => $published_at, 'published_at_human' => $published_at_human, 'editor' => $editor, 'updated_at' => $updated_at, 'likes' => 0, 'comments' => 0);

			array_push($appnews, $article);
			// Her må jeg hente ut det jeg trenger og legge inn i en ny array så dataen er klar for app. Altså full url, forfatter, content osv.
		}
		return \Response::json(array('entries' => $appnews));
	}

	

}
