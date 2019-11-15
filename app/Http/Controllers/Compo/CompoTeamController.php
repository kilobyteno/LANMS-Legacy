<?php

namespace LANMS\Http\Controllers\Compo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use LANMS\Http\Controllers\Controller;
use LANMS\Http\Requests\CompoTeamCreateRequest;
use LANMS\Http\Requests\CompoTeamUpdateRequest;
use LANMS\Notifications\CompoTeamAdded;
use LANMS\Notifications\CompoTeamRemoved;
use LANMS\User;

class CompoTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = \LANMS\CompoTeam::where('user_id', \Sentinel::check()->id)->get();
        return view('compo.team.index')->with('teams', $teams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::active()->except(\Sentinel::getUser()->id);
        return view('compo.team.create')->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompoTeamCreateRequest $request)
    {
        
        $players = array_filter($request->input('players'));
        $array_not_unique = count($players) !== count(array_unique($players));
        if ($array_not_unique === true || in_array(\Sentinel::check()->id, $players)) {
            return \Redirect::back()
                ->with('messagetype', 'warning')
                ->with('message', trans('compo.team.alert.notunique'));
        }
        if (count($players) == 0) {
            return \Redirect::back()
                ->with('messagetype', 'warning')
                ->with('message', trans('compo.team.alert.moreplayers'));
        }
        $creator = \Sentinel::getUser();
        $team = \LANMS\CompoTeam::create([
            'name' => $request->get('name'),
            'user_id' => $creator->id,
        ]);
        $team->players()->attach($players);

        foreach ($players as $user_id) {
            Notification::send(\Sentinel::findById($user_id), new CompoTeamAdded($team));
        }

        return \Redirect::route('compo-team')
                ->with('messagetype', 'success')
                ->with('message', trans('compo.team.alert.created'));
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
        $team = \LANMS\CompoTeam::find($id);
        $users = User::active()->except(\Sentinel::getUser()->id);
        return view('compo.team.edit')->with('team', $team)->with('users', $users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompoTeamUpdateRequest $request, $id)
    {
        $team = \LANMS\CompoTeam::find($id);
        if ($team->composignupsThisYear()->count() > 0) {
            return \Redirect::route('compo-team', $compo->slug)
                ->with('messagetype', 'warning')
                ->with('message', trans('compo.team.alert.cantdelete'));
        }
        $team->update([
            'name' => $request->get('name'),
        ]);
        $players = array_filter($request->input('players'));
        $array_not_unique = count($players) !== count(array_unique($players));
        if ($array_not_unique === true || in_array(\Sentinel::check()->id, $players)) {
            return \Redirect::back()
                ->with('messagetype', 'warning')
                ->with('message', trans('compo.team.alert.notunique'));
        }
        if (count($players) == 0) {
            return \Redirect::back()
                ->with('messagetype', 'warning')
                ->with('message', trans('compo.team.alert.moreplayers'));
        }

        $new = $players;
        $old = $team->players->pluck('id')->toArray();

        $added = array_diff_assoc($new, $old);
        $removed = array_diff_assoc($old, $new);

        foreach ($added as $user_id) {
            Notification::send(\Sentinel::findById($user_id), new CompoTeamAdded($team));
        }

        foreach ($removed as $user_id) {
            Notification::send(\Sentinel::findById($user_id), new CompoTeamRemoved($team));
        }

        $team->players()->detach();
        $team->players()->attach($players);

        return \Redirect::route('compo-team')
                ->with('messagetype', 'success')
                ->with('message', trans('compo.team.alert.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = \LANMS\CompoTeam::find($id);
        if ($team->composignupsThisYear()->count() > 0) {
            return \Redirect::route('compo-team', $compo->slug)
                ->with('messagetype', 'warning')
                ->with('message', trans('compo.team.alert.cantdelete'));
        }
        if ($team->user_id === \Sentinel::check()->id) {
            $team->delete();
            return \Redirect::route('compo-team')->with('messagetype', 'success')->with('message', trans('compo.team.alert.deleted'));
        } else {
            return \Redirect::route('compo-team')->with('messagetype', 'warning')->with('message', trans('global.noaccess'));
        }
    }
}
