<?php

namespace LANMS\Http\Controllers\Member;

use LANMS\Http\Controllers\Controller;
use LANMS\User;

use LANMS\Http\Requests\Member\SearchRequest;

class ProfileController extends Controller {

	public function index($username) {
		$theuser = User::where('username', '=', $username)->first();
		if($theuser == null) {
			return abort(404); //if username does not exist
		}
		$onlinestatus = User::getOnlineStatus($theuser->id);
		$userarray = $theuser->toArray();
		$userarray['onlinestatus'] = $onlinestatus;
		return view('account.profile')->with($userarray);
	}

	public function getMembers() {
		$members = User::orderBy('username', 'asc')->where('last_activity', '<>', '')->paginate(10);
		$newestmembers = User::orderBy('created_at', 'desc')->where('last_activity', '<>', '')->take(4)->get();
		$onlinemembers = User::orderBy('last_activity', 'desc')->where('last_activity', '<>', '')->take(4)->get();
		
		return view('account.members')
				->with('members', $members)
				->with('newestmembers', $newestmembers)
				->with('onlinemembers', $onlinemembers);
	}

	public function search(SearchRequest $request) {

		$members = \Searchy::users('firstname', 'lastname', 'username')->query($request->search)->get();

		$newestmembers = User::orderBy('created_at', 'desc')->where('last_activity', '<>', '')->take(4)->get();
		$onlinemembers = User::orderBy('last_activity', 'desc')->where('last_activity', '<>', '')->take(4)->get();
		
		return view('account.search')
				->with('query', $request->search)
				->with('members', $members)
				->with('newestmembers', $newestmembers)
				->with('onlinemembers', $onlinemembers);
	}

}
