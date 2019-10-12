<?php

namespace LANMS\Http\Controllers\Compo;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use LANMS\Compo;
use LANMS\Http\Controllers\Controller;

class CompoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compos = Compo::thisYear()->get();
        return view('compo.index')->with('compos', $compos);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        if (!Sentinel::getUser()->hasAccess(['admin.compo.*'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $compos = Compo::thisYear()->get();
        return view('compo.index')->with('compos', $compos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Sentinel::getUser()->hasAccess(['admin.compo.create'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        return view('compo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.compo.create'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }

        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'page_id' => 'nullable|integer',
            'challonge_subdomain' => 'nullable|string',
            'challonge_url' => 'nullable|string',
            'type' => 'integer',
            'signup_type' => 'integer',
            'signup_size' => 'required|integer',
            'start_at_date' => 'required|date_format:Y-m-d',
            'start_at_time' => 'required|date_format:H:i',
            'last_sign_up_at_date' => 'required|date_format:Y-m-d',
            'last_sign_up_at_time' => 'required|date_format:H:i',
            'end_at_date' => 'required|date_format:Y-m-d',
            'end_at_time' => 'required|date_format:H:i',
            'start_at_date' => 'required|date_format:Y-m-d',
            'start_at_time' => 'required|date_format:H:i',
        ]);

        $start_at_date = $request->get('start_at_date');
        $start_at_time = $request->get('start_at_time');
        $start_at = date('Y-m-d H:i:s', strtotime("$start_at_date $start_at_time"));

        $last_sign_up_at_date = $request->get('last_sign_up_at_date');
        $last_sign_up_at_time = $request->get('last_sign_up_at_time');
        $last_sign_up_at = date('Y-m-d H:i:s', strtotime("$last_sign_up_at_date $last_sign_up_at_time"));

        $end_at_date = $request->get('end_at_date');
        $end_at_time = $request->get('end_at_time');
        $end_at = date('Y-m-d H:i:s', strtotime("$end_at_date $end_at_time"));

        Compo::create([
            'name' => $request->get('name'),
            'slug' => str_slug($request->get('name'), '-'),
            'description' => $request->get('description'),
            'page_id' => $request->get('page_id'),
            'challonge_subdomain' => $request->get('challonge_subdomain'),
            'challonge_url' => $request->get('challonge_url'),
            'year' => \Setting::get('SEATING_YEAR'),
            'type' => $request->get('type'),
            'signup_type' => $request->get('signup_type'),
            'signup_size' => $request->get('signup_size'),
            'start_at' => $start_at ,
            'last_sign_up_at' => $last_sign_up_at,
            'end_at' => $end_at,
            'author_id' => Sentinel::getUser()->id,
            'editor_id' => Sentinel::getUser()->id,
        ]);

        return Redirect::route('admin-compo')
                ->with('messagetype', 'success')
                ->with('message', 'Created compo successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  Compo  $compo
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $compo = Compo::where('slug', '=', $slug)->first();
        return view('compo.show')->withCompo($compo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Compo  $compo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.compo.update'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $compo = Compo::find($id);
        return view('compo.edit')->withCompo($compo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Compo  $compo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.compo.update'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }

        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'page_id' => 'nullable|integer',
            'challonge_subdomain' => 'nullable|string',
            'challonge_url' => 'nullable|string',
            'type' => 'integer',
            'signup_type' => 'integer',
            'signup_size' => 'required|integer',
            'start_at_date' => 'required|date_format:Y-m-d',
            'start_at_time' => 'required|date_format:H:i',
            'last_sign_up_at_date' => 'required|date_format:Y-m-d',
            'last_sign_up_at_time' => 'required|date_format:H:i',
            'end_at_date' => 'required|date_format:Y-m-d',
            'end_at_time' => 'required|date_format:H:i',
            'start_at_date' => 'required|date_format:Y-m-d',
            'start_at_time' => 'required|date_format:H:i',
        ]);
        
        $compo = Compo::find($id);

        $start_at_date = $request->get('start_at_date');
        $start_at_time = $request->get('start_at_time');
        $start_at = date('Y-m-d H:i:s', strtotime("$start_at_date $start_at_time"));

        $last_sign_up_at_date = $request->get('last_sign_up_at_date');
        $last_sign_up_at_time = $request->get('last_sign_up_at_time');
        $last_sign_up_at = date('Y-m-d H:i:s', strtotime("$last_sign_up_at_date $last_sign_up_at_time"));

        $end_at_date = $request->get('end_at_date');
        $end_at_time = $request->get('end_at_time');
        $end_at = date('Y-m-d H:i:s', strtotime("$end_at_date $end_at_time"));
        
        $compo->update([
            'name' => $request->get('name'),
            'slug' => str_slug($request->get('name'), '-'),
            'description' => $request->get('description'),
            'page_id' => $request->get('page_id'),
            'challonge_subdomain' => $request->get('challonge_subdomain'),
            'challonge_url' => $request->get('challonge_url'),
            'year' => \Setting::get('SEATING_YEAR'),
            'type' => $request->get('type'),
            'signup_type' => $request->get('signup_type'),
            'signup_size' => $request->get('signup_size'),
            'start_at' => $start_at ,
            'last_sign_up_at' => $last_sign_up_at,
            'end_at' => $end_at,
            'editor_id' => Sentinel::getUser()->id,
        ]);

        return Redirect::route('admin-compo')
                ->with('messagetype', 'success')
                ->with('message', 'Updated compo successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Compo  $compo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.compo.destroy'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $compo = Compo::find($id);
        $compo->delete();
        return Redirect::route('admin-compo')
                ->with('messagetype', 'success')
                ->with('message', 'Deleted compo successfully!');
    }
}
