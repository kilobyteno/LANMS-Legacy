<?php

namespace LANMS\Http\Controllers\Member;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use LANMS\Http\Controllers\Controller;
use LANMS\Http\Requests\Member\DeleteAccountRequest;
use LANMS\Http\Requests\Member\PasswordRequest;
use LANMS\Http\Requests\Member\ProfileCoverRequest;
use LANMS\Http\Requests\Member\ProfileImageRequest;
use LANMS\Http\Requests\Member\ProfileRequest;
use LANMS\News;
use LANMS\Rules\OlderThan;
use LANMS\User;
use Regulus\ActivityLog\Models\Activity;

class AccountController extends Controller
{
    public function getDashboard()
    {
        $authuser = Sentinel::getUser();
        $onlinestatus = User::getOnlineStatus($authuser->id);
        $userarray = $authuser->toArray();
        $userarray['onlinestatus'] = $onlinestatus;

        $news = News::isPublished()->get()->take(3);

        return view('account.dashboard')
                    ->with($userarray)
                    ->withNews($news);
    }

    public function getAccount()
    {
        return view('account.index');
    }

    public function getEditProfile()
    {
        $authuser = Sentinel::getUser();
        return view('account.edit-profile')->with($authuser->toArray());
    }

    public function postEditProfile(Request $request)
    {

        $request->validate([
            'firstname' => 'required|between:3,250|regex:/^[\pL\s\-]+$/u',
            'lastname' => 'required|between:3,250|regex:/^[\pL\s\-]+$/u',
            'birthdate' => ['required', 'date_format:Y-m-d', new OlderThan],
            'phone' => 'required|phone:LENIENT,NO',
            'phone_country' => 'alpha|max:3|required_with:phone',
            'gender' => '',
            'location' => 'regex:/^[A-Za-z ,\']+$/|nullable',
            'occupation' => 'regex:/^[A-Za-z ,\']+$/|nullable',
            'showemail' => 'integer',
            'showname' => 'integer',
            'showonline' => 'integer',
            'language' => '',
            'theme' => '',
            'about' => 'nullable',
            'clothing_size' => 'nullable',
            'address_street' => 'nullable|regex:/^((.){1,}(\d){1,}(.){0,})$/|max:150',
            'address_postalcode' => 'nullable|alpha_dash|min:4',
            'address_city' => 'nullable|regex:/^[A-Za-z \Wæøå]+$/',
            'address_county' => 'nullable|regex:/^[A-Za-z \Wæøå]+$/',
            'address_country' => 'nullable|alpha',
        ]);

        $user = Sentinel::getUser();

        $credentials = [
            'login'         => $user->username,
            'password'      => $request->get('password'),
        ];

        if (!Sentinel::authenticate($credentials)) {
            return Redirect::route('user-profile-edit', $user->username)
                    ->with('messagetype', 'warning')
                    ->with('message', trans('user.account.details.alert.wrongpassword'));
        }

        $phone = $request->get('phone');
        $phone_verified_at = $user->phone_verified_at;
        if ($phone != $user->phone) {
            $phone_verified_at = null;
        }

        if (is_null($phone)) {
            $phone_country = null;
        } else {
            $phone_country = $request->get('phone_country');
        }

        $info = [
            'firstname'         => $request->get('firstname'),
            'lastname'          => $request->get('lastname'),
            'gender'            => $request->get('gender'),
            'location'          => $request->get('location'),
            'occupation'        => $request->get('occupation'),
            'birthdate'         => $request->get('birthdate'),
            'phone'             => $phone,
            'phone_country'     => $phone_country,
            'phone_verified_at' => $phone_verified_at,
            'about'             => $request->get('about'),
            'showemail'         => $request->get('showemail'),
            'showname'          => $request->get('showname'),
            'showonline'        => $request->get('showonline'),
            'language'          => $request->get('language'),
            'theme'             => $request->get('theme'),
            'clothing_size'     => $request->get('clothing_size'),
            'address_street' => $request->get('address_street'),
            'address_postalcode' => $request->get('address_postalcode'),
            'address_city' => $request->get('address_city'),
            'address_county' => $request->get('address_county'),
            'address_country' => $request->get('address_country'),
        ];

        $updateuser = Sentinel::update($user, $info);

        if ($user->stripecustomer) {
            \Stripe::customers()->update($user->stripecustomer->cus, [
                'email' => $user->email,
                'name' => $info['firstname'].' '.$info['lastname'],
            ]);
        } else {
            \Stripe::customers()->create([
                'email' => $user->email,
                'name' => $info['firstname'].' '.$info['lastname'],
            ]);
        }

        if ($updateuser) {
            return Redirect::route('user-profile', $user->username)
                    ->with('messagetype', 'success')
                    ->with('message', trans('user.account.details.alert.saved'));
        } else {
            return Redirect::route('user-profile', $user->username)
                ->with('messagetype', 'danger')
                ->with('message', trans('user.account.details.alert.failed'));
        }
    }

    public function getChangePassword()
    {
        return view('account.changepassword');
    }

    public function postChangePassword(PasswordRequest $request)
    {
        $finduser = Sentinel::findById(Sentinel::getUser()->id);

        $credentials = [
            'username'      => Sentinel::getUser()->username,
            'password'      => $request->get('current_password'),
        ];

        if (Sentinel::authenticate($credentials)) {
            $info = [
                'password'      => $request->get('password')
            ];

            $updateuser = Sentinel::update($finduser, $info);

            if ($updateuser) {
                Sentinel::logout();
                return Redirect::route('home')
                        ->with('messagetype', 'success')
                        ->with('message', trans('user.account.changepassword.alert.saved'));
            } else {
                return Redirect::route('account-change-password')
                    ->with('messagetype', 'danger')
                    ->with('message', trans('user.account.changepassword.alert.failed'));
            }
        } else {
            return Redirect::route('account-change-password')
                    ->with('messagetype', 'warning')
                    ->with('message', trans('user.account.changepassword.alert.wrongpassword'));
        }
    }

    public function getChangeImages()
    {
        $authuser = Sentinel::getUser();
        return view('account.changeimages')->with($authuser->toArray());
    }

    public function postChangeProfileImage(ProfileImageRequest $request)
    {
        $finduser           = Sentinel::findById(Sentinel::getUser()->id);

        $image              = $request->file('profileimage');

        if ($image == null) {
            return Redirect::route('account-change-images')
                    ->with('messagetype', 'warning')
                    ->with('message', trans('user.profile.changeimages.alert.noimage'));
        }
        
        $filename           = Sentinel::getUser()->id . '.' . $image->getClientOriginalExtension();
        $path               = public_path() . '/images/profilepicture/' . $filename;
        $webpath            = '/images/profilepicture/' . $filename;

        $filename_small     = Sentinel::getUser()->id . '_small.' . $image->getClientOriginalExtension();
        $path_small         = public_path() . '/images/profilepicture/' . $filename_small;
        $webpath_small      = '/images/profilepicture/' . $filename_small;

        $imagesave          = Image::make($image->getRealPath())->fit(115)->save($path);
        $imagesave_small    = Image::make($image->getRealPath())->fit(75)->save($path_small);

        $info = [
            'profilepicture'        => $webpath,
            'profilepicturesmall'   => $webpath_small,
        ];
        $updateuser = Sentinel::update($finduser, $info);

        if ($imagesave && $updateuser && $imagesave_small) {
            return Redirect::route('account-change-images')
                    ->with('messagetype', 'success')
                    ->with('message', trans('user.profile.changeimages.alert.saved'));
        } else {
            return Redirect::route('account-change-images')
                    ->with('messagetype', 'danger')
                    ->with('message', trans('user.profile.changeimages.alert.failed'));
        }
    }

    public function postChangeProfileCover(ProfileCoverRequest $request)
    {
        $finduser           = Sentinel::findById(Sentinel::getUser()->id);

        $image              = $request->file('profilecover');

        if ($image == null) {
            return Redirect::route('account-change-images')
                    ->with('messagetype', 'warning')
                    ->with('message', trans('user.profile.changeimages.alert.noimage'));
        }
        
        $filename           = Sentinel::getUser()->id . '.' . $image->getClientOriginalExtension();
        $path               = public_path() . '/images/profilecover/' . $filename;
        $webpath            = '/images/profilecover/' . $filename;

        $imagesave          = Image::make($image->getRealPath())->resize(1920, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path);

        $info = [
            'profilecover'      => $webpath,
        ];
        $updateuser = Sentinel::update($finduser, $info);

        if ($imagesave && $updateuser) {
            return Redirect::route('account-change-images')
                    ->with('messagetype', 'success')
                    ->with('message', trans('user.profile.changeimages.alert.saved'));
        } else {
            return Redirect::route('account-change-images')
                    ->with('messagetype', 'danger')
                    ->with('message', trans('user.profile.changeimages.alert.failed'));
        }
    }

    public function getGDPRDownload()
    {
        return view('account.gdpr.download');
    }

    public function getGDPRDelete()
    {
        return view('account.gdpr.delete');
    }

    public function postGDPRDelete(DeleteAccountRequest $request)
    {
        $credentials = [
            'login'         => \Sentinel::getUser()->username,
            'password'      => $request->input('password'),
        ];

        abort_unless(\Sentinel::authenticate($credentials), 403);

        $user = User::findOrFail(\Sentinel::getUser()->id);

        abort_unless($user, 403);

        $user->anonymize();

        \Sentinel::update($user, [
            'isAnonymized' => true
        ]);

        \Sentinel::logout();

        return Redirect::route('home')
                        ->with('messagetype', 'success')
                        ->with('message', trans('user.gdpr.delete.alert.saved'));
    }
}
