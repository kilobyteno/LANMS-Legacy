<?php

namespace LANMS\Http\Controllers\Admin;

use LANMS\Compo;
use LANMS\CompoSignUp;
use Illuminate\Http\Request;
use LANMS\Http\Controllers\Controller;

class CompoAdminSignUpController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($id): \Illuminate\View\View
    {
        $compo = Compo::find($id);
        if (\Carbon\Carbon::now() < $compo->first_sign_up_at) {
            return \Redirect::route('compo-show', $compo->slug)
                ->with('messagetype', 'warning')
                ->with('message', __('compo.signup.alert.firstsignupbefore'));
        }
        if ($compo->last_sign_up_at < \Carbon\Carbon::now()) {
            return \Redirect::route('compo-show', $compo->slug)
                ->with('messagetype', 'warning')
                ->with('message', __('compo.signup.alert.lastsignuppast'));
        }
        if ($compo->max_signups && $compo->signupsThisYear->count() >= $compo->max_signups) {
            return \Redirect::route('compo-show', $compo->slug)
                ->with('messagetype', 'warning')
                ->with('message', __('compo.signup.alert.maxsignups'));
        }
        return view('compo.signup.show')->withCompo($compo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $compo = Compo::find($id);
        $user_id = $request->get('id');
        $user = \LANMS\User::find($user_id);
        if ($user->composignups()->where('compo_id', $compo->id)->first()) {
            return \Redirect::route('admin-compo-edit', $compo->id)
                ->with('messagetype', 'warning')
                ->with('message', __('compo.signup.alert.alreadysignedup'));
        }

        if (\Carbon\Carbon::now() < $compo->first_sign_up_at) {
            return \Redirect::route('admin-compo-edit', $compo->id)
                ->with('messagetype', 'warning')
                ->with('message', __('compo.signup.alert.firstsignupbefore'));
        }

        if ($compo->last_sign_up_at < \Carbon\Carbon::now()) {
            return \Redirect::route('admin-compo-edit', $compo->id)
                ->with('messagetype', 'warning')
                ->with('message', __('compo.signup.alert.lastsignuppast'));
        }

        if ($compo->max_signups && $compo->signupsThisYear->count() >= $compo->max_signups) {
            return \Redirect::route('admin-compo-edit', $compo->id)
                ->with('messagetype', 'warning')
                ->with('message', __('compo.signup.alert.maxsignups'));
        }

        if ($compo->signup_type == 1) {
            $request->validate([
                'team' => 'required',
                'read_rules' => 'accepted',
            ]);
            $team_id = $request->team;
            $team = \LANMS\CompoTeam::find($team_id);
            $players = $team->players->count();
            $players += 1;
            if ($compo->signup_size != $players) {
                return \Redirect::route('admin-compo-edit', $compo->id)
                    ->with('messagetype', 'warning')
                    ->with('message', __('compo.signup.alert.signupsize'));
            }
        } else {
            $request->validate([
                'read_rules' => 'accepted',
            ]);
            $team_id = null;
        }

        $signup = \LANMS\CompoSignUp::create([
            'compo_id' => $compo->id,
            'team_id' => $team_id,
            'user_id' => $request->get('id') ?? null,
            'year' => \Setting::get('SEATING_YEAR'),
        ]);
        return \Redirect::route('admin-compo-edit', $compo->id)
                ->with('messagetype', 'success')
                ->with('message', trans_choice('compo.signup.alert.signedup', $compo->signup_type));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $signup_id)
    {
        $signup = CompoSignUp::find($signup_id);
        if (!$signup) {
            return \Redirect::back();
        }
        $compo = Compo::find($id);
        if (!$compo) {
            return \Redirect::back();
        }
        $user = $signup->user;

        if (!$user->composignups()->where('compo_id', $compo->id)->first()) {
            return \Redirect::back();
        }

        if (\Carbon\Carbon::now() > $compo->start_at) {
            return \Redirect::route('admin-compo-edit', $compo->id)
                ->with('messagetype', 'warning')
                ->with('message', __('compo.signup.alert.alreadystarted'));
        }

        $signup->delete();

        return \Redirect::route('admin-compo-edit', $compo->id)
                ->with('messagetype', 'success')
                ->with('message', trans_choice('compo.signup.alert.cancelled', $compo->signup_type));
    }
}
