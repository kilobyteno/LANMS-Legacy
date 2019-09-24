<?php

namespace LANMS\Http\Controllers\Admin;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use LANMS\Email;
use LANMS\Http\Controllers\Controller;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Sentinel::getUser()->hasAccess(['admin.emails.*'])) {
            return Redirect::route('admin')->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $emails = Email::all();
        return view('emails.index')->withEmails($emails);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Sentinel::getUser()->hasAccess(['admin.emails.create'])) {
            return Redirect::route('admin')->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        return view('emails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.emails.create'])) {
            return Redirect::route('admin')->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        dd(Email::find(1));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.emails.*'])) {
            return Redirect::route('admin')->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $email = Email::find($id);
        return view('emails.show')->withEmail($email);
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
    public function destroy($id)
    {
        //
    }
}
