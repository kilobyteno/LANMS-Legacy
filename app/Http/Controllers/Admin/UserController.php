<?php

namespace LANMS\Http\Controllers\Admin;

use Illuminate\Http\Request;
use LANMS\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Roles\EloquentRole;

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
        if (Sentinel::getUser()->hasAccess(['admin.users.*'])) {
            $users = User::withTrashed()->get();
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
        if (Sentinel::getUser()->hasAccess(['admin.users.update'])) {
            $user = User::withTrashed()->find($id);
            $roles = EloquentRole::where('name', '<>', 'Default')->get();
            return view('user.edit')->withUser($user)->withRoles($roles);
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
        if (!Sentinel::getUser()->hasAccess(['admin.users.update'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }

        $finduser = Sentinel::findById($id);

        $info = [
            'firstname'         => $request->get('firstname'),
            'lastname'          => $request->get('lastname'),
            'username'          => $request->get('username'),
            'email'             => $request->get('email'),
            'gender'            => $request->get('gender'),
            'location'          => $request->get('location'),
            'occupation'        => $request->get('occupation'),
            'birthdate'         => $request->get('birthdate'),
            'phone_country'     => $request->get('phone_country'),
            'phone'             => $request->get('phone'),
            'about'             => $request->get('about'),
            'showemail'         => $request->get('showemail'),
            'showname'          => $request->get('showname'),
            'showonline'        => $request->get('showonline'),
            'language'          => $request->get('language'),
            'theme'             => $request->get('theme'),
            'about'             => $request->get('about'),
            'clothing_size'     => $request->get('clothing_size'),
            'address_street' => $request->get('address_street'),
            'address_postalcode' => $request->get('address_postalcode'),
            'address_city' => $request->get('address_city'),
            'address_county' => $request->get('address_county'),
            'address_country' => $request->get('address_country'),
        ];

        $updateuser = Sentinel::update($finduser, $info);

        if ($updateuser) {
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
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function updatePermission($id, Request $request)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.users.update'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $request->validate([
            'role-*' => 'accepted',
        ]);

        $sadmin = Sentinel::findRoleBySlug('superadmin');

        if ($sadmin->users()->count() <= 2 && !$request->input('role-superadmin') && $sadmin->users()->pluck('id')->contains($id)) {
            return Redirect::route('admin-user-edit', $id)
                            ->with('messagetype', 'warning')
                            ->with('message', 'Cannot update permissions, there can\'t be less than two Super Administrators!');
        }

        $user = Sentinel::findById($id);

        foreach ($user->roles as $role) {
            $role->users()->detach($user);
        }

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'role-') !== false) {
                $roleslug = str_replace('role-', '', $key);
                $role = Sentinel::findRoleBySlug($roleslug);
                if (!$role) {
                    return Redirect::route('admin-user-edit', $id)
                            ->with('messagetype', 'warning')
                            ->with('message', 'Did not find role!');
                }
                $role->users()->attach($user);
            }
        }

        return Redirect::route('admin-user-edit', $id)
                ->with('messagetype', 'success')
                ->with('message', 'The permissions has been saved!');
    }

    public function getResendVerification($id)
    {
        $user = \User::withTrashed()->find($id);
        if (is_null($user)) {
            return Redirect::route('admin-users')->with('messagetype', 'danger')
                                ->with('message', __('auth.alert.usernotfound'));
        }

        // Check the activations table for the user_id
        $activation = \Activation::where('user_id', '=', $user->id)->first();
        if (!$activation) {
            // Create an activation record
            $activation = \Activation::create($user);
        }
        if ($activation->completed == 1) {
            return Redirect::route('admin-users')->with('messagetype', 'warning')
                                ->with('message', __('auth.alert.alreadyactivated'));
        }
        $activation_code = $activation->code;

        try {
            \Mail::send(
                'emails.auth.activate',
                array(
                    'link' => \URL::route('account-activate', $activation_code),
                    'firstname' => $user->firstname
                ),
                function ($message) use ($user) {
                    $message->to($user->email, $user->firstname)->subject(__('email.auth.activate.title'));
                }
            );
        } catch (\Swift_TransportException $e) {
            return Redirect::route('admin-user-edit', $id)->with('messagetype', 'warning')
                    ->with('message', __('auth.alert.emailfailure').' Error: '.$e->getMessage());
        }

        return Redirect::route('admin-users')->with('messagetype', 'success')
                                ->with('message', 'Email was sent.');
    }

    public function getForgotPassword($id)
    {
        $user = \User::withTrashed()->find($id);
        if (is_null($user)) {
            return Redirect::route('admin-users')->with('messagetype', 'error')
                                    ->with('message', __('auth.alert.usernotfound'));
        }

        $actex = \Activation::exists($user);
        $actco = \Activation::completed($user);
        $active = false;
        if ($actex && !$actco) {
            $active = false;
        } elseif ($actco) {
            $active = true;
        }

        if (!$active) {
            return Redirect::route('admin-user-edit', $id)->with('messagetype', 'warning')
                                    ->with('message', 'User is not active.');
        }

        $reminder = \Reminder::exists($user);
        if (!$reminder) {
            $reminder = \Reminder::create($user);
        }
        $reminder_code  = $reminder->code;

        try {
            \Mail::send(
                'emails.auth.forgot-password',
                array(
                    'link' => \URL::route('account-reset-password', $reminder_code),
                    'firstname' => $user->firstname,
                    'username' => $user->username,
                ),
                function ($message) use ($user) {
                    $message->to($user->email, $user->firstname)->subject(__('email.auth.forgotpassword.title'));
                }
            );
        } catch (\Swift_TransportException $e) {
            return Redirect::route('admin-user-edit', $id)->with('messagetype', 'warning')
                                ->with('message', __('auth.alert.emailfailure').' Error: '.$e->getMessage());
        }
        
        return Redirect::route('admin-user-edit', $id)->with('messagetype', 'success')
                        ->with('message', 'Email was sent.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.users.destroy'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }

        $user = User::find($id);
        if ($user->delete()) {
            return Redirect::route('admin-users')
                    ->with('messagetype', 'success')
                    ->with('message', 'The user has now been deleted!');
        } else {
            return Redirect::route('admin-users')
                ->with('messagetype', 'danger')
                ->with('message', 'Something went wrong while deleting the user.');
        }
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function restore($id)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.users.restore'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }

        $user = User::withTrashed()->find($id);
        if ($user->restore()) {
            return Redirect::route('admin-users')
                    ->with('messagetype', 'success')
                    ->with('message', 'The user has now been restored!');
        } else {
            return Redirect::route('admin-users')
                ->with('messagetype', 'danger')
                ->with('message', 'Something went wrong while restoring the user.');
        }
    }
}
