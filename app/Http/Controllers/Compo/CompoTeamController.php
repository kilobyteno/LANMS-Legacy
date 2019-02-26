<?php

namespace LANMS\Http\Controllers\Compo;

use Illuminate\Http\Request;
use LANMS\Http\Controllers\Controller;
use LANMS\Http\Requests\CompoTeamCreateRequest;
use LANMS\Http\Requests\CompoTeamUpdateRequest;

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
        return view('compo.team.create');
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
        
        $team = \LANMS\CompoTeam::create([
            'name' => $request->get('name'),
            'user_id' => \Sentinel::getUser()->id,
        ]);
        $team->players()->attach($players);

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
        return view('compo.team.edit')->withTeam($team);
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
        if ($team->user_id === \Sentinel::check()->id) {
            $team->delete();
            return \Redirect::route('compo-team')->with('messagetype', 'success')->with('message', trans('compo.team.alert.deleted'));
        } else {
            return \Redirect::route('compo-team')->with('messagetype', 'warning')->with('message', trans('global.noaccess'));
        }
    }
}
