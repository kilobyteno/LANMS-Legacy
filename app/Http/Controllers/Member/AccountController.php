<?php

namespace LANMS\Http\Controllers\Member;

use LANMS\Http\Controllers\Controller;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Redirect;

use Intervention\Image\Facades\Image;
use Regulus\ActivityLog\Models\Activity;

use LANMS\Http\Requests\Member\ProfileRequest;
use LANMS\Http\Requests\Member\PasswordRequest;
use LANMS\Http\Requests\Member\ProfileImageRequest;
use LANMS\Http\Requests\Member\ProfileCoverRequest;

use LANMS\User;
use LANMS\News;

class AccountController extends Controller {

	public function getDashboard() {
		$authuser = Sentinel::getUser();
		$onlinestatus = User::getOnlineStatus($authuser->id);
		$userarray = $authuser->toArray();
		$userarray['onlinestatus'] = $onlinestatus;

		$news = News::isPublished()->get()->take(2);

		return view('account.dashboard')
					->with($userarray)
					->withNews($news);
	}

	public function getAccount() {
		return view('account.index');
	}

	public function getEditProfile() {
		$authuser = Sentinel::getUser();
		return view('account.edit-profile')->with($authuser->toArray());
	}

	public function postEditProfile(ProfileRequest $request) {

		$finduser = Sentinel::findById(Sentinel::getUser()->id);

		$credentials = [
			'login' 		=> Sentinel::getUser()->username,
			'password' 		=> $request->get('password'),
		];

		if (Sentinel::authenticate($credentials)) {

			$info = [
				'firstname' 		=> $request->get('firstname'),
				'lastname' 			=> $request->get('lastname'),
				'gender' 			=> $request->get('gender'),
				'location' 			=> $request->get('location'),
				'occupation' 		=> $request->get('occupation'),
				'birthdate' 		=> $request->get('birthdate'),
				'about' 			=> $request->get('about'),
				'showemail' 		=> $request->get('showemail'),
				'showname' 			=> $request->get('showname'),
				'showonline' 		=> $request->get('showonline'),
				'userdateformat' 	=> $request->get('userdateformat'),
				'usertimeformat' 	=> $request->get('usertimeformat'),
			];

			$updateuser = Sentinel::update($finduser, $info);

			if($updateuser) {
				return Redirect::route('user-profile', Sentinel::getUser()->username)
						->with('messagetype', 'success')
						->with('message', 'Your details has been changed!');
			} else {
				return Redirect::route('user-profile', Sentinel::getUser()->username)
					->with('messagetype', 'danger')
					->with('message', 'Something went wrong when saving your details.');
			}
		} else {
			return Redirect::route('user-profile-edit', Sentinel::getUser()->username)
					->with('messagetype', 'warning')
					->with('message', 'Wrong password. Please try again.');
		}
	}

	public function getChangePassword() {
		return view('account.changepassword');
	}

	public function postChangePassword(PasswordRequest $request) {

		$finduser = Sentinel::findById(Sentinel::getUser()->id);

		$credentials = [
			'username' 		=> Sentinel::getUser()->username,
			'password' 		=> $request->get('current_password'),
		];

		if (Sentinel::authenticate($credentials)) {

			$info = [
				'password' 		=> $request->get('password')
			];

			$updateuser = Sentinel::update($finduser, $info);

			if($updateuser) {
				Sentinel::logout();
				return Redirect::route('home')
						->with('messagetype', 'success')
						->with('message', 'Your password has been changed! Please login again to confirm the password change.');
			} else {
				return Redirect::route('account-change-password')
					->with('messagetype', 'danger')
					->with('message', 'Something went wrong when saving your password.');
			}

		} else {
			return Redirect::route('account-change-password')
					->with('messagetype', 'warning')
					->with('message', 'Your current password does not seem to match.');
		}

	}

	public function getChangeImages() {
		$authuser = Sentinel::getUser();
		return view('account.changeimages')->with($authuser->toArray());
	}

	public function postChangeProfileImage(ProfileImageRequest $request) {
		
		$finduser 			= Sentinel::findById(Sentinel::getUser()->id);

		$image 				= $request->file('profileimage');

		if($image == null) {
			return Redirect::route('account-change-images')
					->with('messagetype', 'warning')
					->with('message', 'Please select an image.');
		}
		
		$filename 			= Sentinel::getUser()->id . '.' . $image->getClientOriginalExtension();
		$path 				= public_path() . '/images/profilepicture/' . $filename;
		$webpath			= '/images/profilepicture/' . $filename;

		$filename_small		= Sentinel::getUser()->id . '_small.' . $image->getClientOriginalExtension();
		$path_small 		= public_path() . '/images/profilepicture/' . $filename_small;
		$webpath_small		= '/images/profilepicture/' . $filename_small;

		$imagesave 			= Image::make($image->getRealPath())->fit(115)->save($path);
		$imagesave_small 	= Image::make($image->getRealPath())->fit(75)->save($path_small);

		$info = [
			'profilepicture' 		=> $webpath,
			'profilepicturesmall' 	=> $webpath_small,
		];
		$updateuser = Sentinel::update($finduser, $info);

		if($imagesave && $updateuser && $imagesave_small) {
			return Redirect::route('account-change-images')
					->with('messagetype', 'success')
					->with('message', 'Your profile picture has been changed!');
		} else {
			return Redirect::route('account-change-images')
					->with('messagetype', 'danger')
					->with('message', 'Your profile picture could not be uploaded.');
		}

	}

	public function postChangeProfileCover(ProfileCoverRequest $request) {
		
		$finduser 			= Sentinel::findById(Sentinel::getUser()->id);

		$image 				= $request->file('profilecover');

		if($image == null) {
			return Redirect::route('account-change-images')
					->with('messagetype', 'warning')
					->with('message', 'Please select an image.');
		}
		
		$filename 			= Sentinel::getUser()->id . '.' . $image->getClientOriginalExtension();
		$path 				= public_path() . '/images/profilecover/' . $filename;
		$webpath			= '/images/profilecover/' . $filename;

		$imagesave 			= Image::make($image->getRealPath())->resize(1920, null, function($constraint){ $constraint->aspectRatio(); })->save($path);

		$info = [
			'profilecover' 		=> $webpath,
		];
		$updateuser = Sentinel::update($finduser, $info);

		if($imagesave && $updateuser) {
			return Redirect::route('account-change-images')
					->with('messagetype', 'success')
					->with('message', 'Your profile cover has been changed!');
		} else {
			return Redirect::route('account-change-images')
					->with('messagetype', 'danger')
					->with('message', 'Your profile cover could not be uploaded.');
		}

	}

	public function getGDPRDownload() {
		return view('account.gdpr.download');
	}

	public function getGDPRDelete() {
		return view('account.gdpr.delete');
	}

}
