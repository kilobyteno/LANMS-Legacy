<?php

namespace LANMS\Http\Controllers\Compo;

use LANMS\Compo;
use LANMS\CompoSignUp;
use Illuminate\Http\Request;
use LANMS\Http\Controllers\Controller;

class CompoSignUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $compo = Compo::where('slug', '=', $slug)->first();
        if (\Sentinel::check()->composignups()->where('compo_id', $compo->id)->first()) {
            return \Redirect::route('compo-show', $compo->slug)
                ->with('messagetype', 'warning')
                ->with('message', trans('compo.signup.alert.alreadysignedup'));
        }
        if (\Carbon\Carbon::now() < $compo->first_sign_up_at) {
            return \Redirect::route('compo-show', $compo->slug)
                ->with('messagetype', 'warning')
                ->with('message', trans('compo.signup.alert.firstsignupbefore'));
        }
        if ($compo->last_sign_up_at < \Carbon\Carbon::now()) {
            return \Redirect::route('compo-show', $compo->slug)
                ->with('messagetype', 'warning')
                ->with('message', trans('compo.signup.alert.lastsignuppast'));
        }
        if ($compo->max_signups && $compo->signupsThisYear->count() >= $compo->max_signups) {
            return \Redirect::route('compo-show', $compo->slug)
                ->with('messagetype', 'warning')
                ->with('message', trans('compo.signup.alert.maxsignups'));
        }
        return view('compo.signup.show')->withCompo($compo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $slug)
    {
        $compo = Compo::where('slug', '=', $slug)->first();
        if (\Sentinel::check()->composignups()->where('compo_id', $compo->id)->first()) {
            return \Redirect::route('compo-show', $compo->slug)
                ->with('messagetype', 'warning')
                ->with('message', trans('compo.signup.alert.alreadysignedup'));
        }

        if (\Carbon\Carbon::now() < $compo->first_sign_up_at) {
            return \Redirect::route('compo-show', $compo->slug)
                ->with('messagetype', 'warning')
                ->with('message', trans('compo.signup.alert.firstsignupbefore'));
        }

        if ($compo->last_sign_up_at < \Carbon\Carbon::now()) {
            return \Redirect::route('compo-show', $compo->slug)
                ->with('messagetype', 'warning')
                ->with('message', trans('compo.signup.alert.lastsignuppast'));
        }

        if ($compo->max_signups && $compo->signupsThisYear->count() >= $compo->max_signups) {
            return \Redirect::route('compo-show', $compo->slug)
                ->with('messagetype', 'warning')
                ->with('message', trans('compo.signup.alert.maxsignups'));
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
                return \Redirect::route('compo-show', $compo->slug)
                    ->with('messagetype', 'warning')
                    ->with('message', trans('compo.signup.alert.signupsize'));
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
            'user_id' => \Sentinel::getUser()->id,
            'year' => \Setting::get('SEATING_YEAR'),
        ]);
        return \Redirect::route('compo-show', $compo->slug)
                ->with('messagetype', 'success')
                ->with('message', trans_choice('compo.signup.alert.signedup', $compo->signup_type));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $compo = Compo::where('slug', $slug)->first();
        if (!\Sentinel::check()->composignups()->where('compo_id', $compo->id)->first()) {
            return \Redirect::back();
        }

        if (\Carbon\Carbon::now() > $compo->start_at) {
            return \Redirect::route('compo-show', $compo->slug)
                ->with('messagetype', 'warning')
                ->with('message', trans('compo.signup.alert.alreadystarted'));
        }

        $team_id = null;
        if ($compo->signup_type == 1) { // IS TEAM
            $signup = \LANMS\CompoSignUp::where('compo_id', $compo->id)->where('user_id', \Sentinel::getUser()->id)->where('team_id', "!=", $team_id)->first();
        } else {
            $signup = \LANMS\CompoSignUp::where('compo_id', $compo->id)->where('user_id', \Sentinel::getUser()->id)->where('team_id', $team_id)->first();
        }

        

        if (!$signup) {
            return \Redirect::back();
        }

        $signup->delete();

        return \Redirect::route('compo-show', $compo->slug)
                ->with('messagetype', 'success')
                ->with('message', trans_choice('compo.signup.alert.cancelled', $compo->signup_type));
    }
}
