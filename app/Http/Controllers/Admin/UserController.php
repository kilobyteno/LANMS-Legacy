<?php

namespace LANMS\Http\Controllers\Admin;

use Illuminate\Http\Request;
use LANMS\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use LANMS\User;

use LANMS\Http\Requests\Admin\UserEditRequest;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Sentinel::getUser()->hasAccess(['admin.users.*'])){
			$users = User::all();
			return view('user.index')
						->with('users', $users);
		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(SponsorCreateRequest $request)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if (Sentinel::getUser()->hasAccess(['admin.users.update'])){
			$user = User::find($id);
			return view('user.edit')->withUser($user);
		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, UserEditRequest $request)
	{
		if (!Sentinel::getUser()->hasAccess(['admin.users.update'])){
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}

		$finduser = Sentinel::findById($id);

		$info = [
			'firstname' 		=> $request->get('firstname'),
			'lastname' 			=> $request->get('lastname'),
			'username' 			=> $request->get('username'),
			'email' 			=> $request->get('email'),
			'gender' 			=> $request->get('gender'),
			'location' 			=> $request->get('location'),
			'occupation' 		=> $request->get('occupation'),
			'birthdate' 		=> $request->get('birthdate'),
			'showemail' 		=> $request->get('showemail'),
			'showname' 			=> $request->get('showname'),
			'showonline' 		=> $request->get('showonline'),
			'userdateformat' 	=> $request->get('userdateformat'),
			'usertimeformat' 	=> $request->get('usertimeformat'),
		];

		$updateuser = Sentinel::update($finduser, $info);

		if($updateuser) {
			return Redirect::route('admin-user-edit', $id)
					->with('messagetype', 'success')
					->with('message', 'The user details has been saved!');
		} else {
			return Redirect::route('admin-user-edit', $id)
				->with('messagetype', 'danger')
				->with('message', 'Something went wrong when saving your details.');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if (!Sentinel::getUser()->hasAccess(['admin.users.destroy'])){
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}

		$user = User::find($id);
		if($user->delete()) {
			return Redirect::route('admin-users')
					->with('messagetype', 'success')
					->with('message', 'The user has now been deleted!');
		} else {
			return Redirect::route('admin-users')
				->with('messagetype', 'danger')
				->with('message', 'Something went wrong while deleting the page.');
		}
	}
}
