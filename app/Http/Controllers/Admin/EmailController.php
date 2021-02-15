<?php

namespace LANMS\Http\Controllers\Admin;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use LANMS\Email;
use LANMS\Http\Controllers\Controller;
use LANMS\SeatTicket;
use LANMS\User;
use Swift_TransportException;

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
        return response()->view('emails.index')->withEmails($emails);
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
        return response()->view('emails.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test()
    {
        if (!Sentinel::getUser()->hasAccess(['admin.emails.create'])) {
            return Redirect::route('admin')->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        try {
            Mail::raw('Test email was sent successfully!', function($message) {
                $message->to(Sentinel::getUser()->email)->subject('Test email');
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });
        } catch (Swift_TransportException $e) {
            return Redirect::route('admin-emails')
                    ->with('messagetype', 'danger')
                    ->with('message', '<strong>Something went wrong while sending a test email!</strong><br><br>'.$e->getMessage());
        }

        if(count(Mail::failures()) > 0 ) {
            return Redirect::route('admin-emails')
                    ->with('messagetype', 'danger')
                    ->with('message', '<strong>Something went wrong while sending a test email!</strong> Check the system logs.');
        } else {
            return Redirect::route('admin-emails')
                    ->with('messagetype', 'success')
                    ->with('message', 'The test email was sent to: '.Sentinel::getUser()->email);
        }
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
        $request->validate([
            'user' => 'required_without:bulk',
            'bulk' => 'required_without:user',
            'subject' => 'required|string',
            'content' => 'required|string',
        ]);

        if ($request->user) {
            $user = User::find($request->user);
            if (!$user) {
                return Redirect::route('admin-emails-create')->with('messagetype', 'warning')
                                ->with('message', 'User not found! ')->withInput();
            }
            $dbcontent = view('emails.admin.message')->withFirstname($user->firstname)->withSubject($request->subject)->withContent($request->content)->render();
            $subject = $request->subject;
            $email = Email::create([
                'content' => $dbcontent,
                'subject' => $subject,
                'author_id' => Sentinel::getUser()->id,
            ]);
            $email->users()->attach($user->id);
                $firstname = ($user->firstname) ? $user->firstname : $user->username;
                Mail::send('emails.admin.message', array('content' => $request->content, 'subject' => $subject, 'firstname' => $firstname), function ($message) use ($user, $subject, $firstname) {
                    $message->to($user->email, $firstname)->subject($subject);
                });
        } elseif ($request->bulk) {
            $bulk = $request->bulk;
            $users = null;
            if ($bulk == 1) { // ALL ACTIVE USERS
                $users = User::where('last_activity', '<>', '')->where('isAnonymized', '0')->get();
            } elseif ($bulk == 2) { // ALL USERS WITH A TICKET FOR THIS EVENT
                $users = SeatTicket::thisYear()->with('user')->get()->pluck('user')->flatten();
                $users = $users->where('isAnonymized', '0')->unique();
            } elseif ($bulk == 3) { // ALL USERS WITH A TICKET FOR -LAST- EVENT
                $users = SeatTicket::lastYear()->with('user')->get()->pluck('user')->flatten();
                $users = $users->where('isAnonymized', '0')->unique();
            } else {
                return Redirect::route('admin-emails-create')->with('messagetype', 'danger')
                                ->with('message', 'Not a valid bulk has been selected. '.$bulk)->withInput();
            }
            if (!$users) {
                return Redirect::route('admin-emails-create')->with('messagetype', 'danger')
                                ->with('message', 'Could not find users for this bulk.')->withInput();
            }
            // SEND EMAIL TO ALL USERS IN LIST
            foreach ($users as $user) {
                $firstname = ($user->firstname) ? $user->firstname : $user->username;
                Mail::send('emails.admin.message', array('content' => $request->content, 'subject' => $request->subject, 'firstname' => $firstname), function ($message) use ($user, $request, $firstname) {
                    $message->to($user->email, $firstname)->subject($request->subject);
                });
            }
            $dbcontent = view('emails.admin.message')->withFirstname('firstname')->withSubject($request->subject)->withContent($request->content)->render();
            $subject = $request->subject;
            $email = Email::create([
                'content' => $dbcontent,
                'subject' => $subject,
                'author_id' => Sentinel::getUser()->id,
            ]);
            $email->users()->attach($users->pluck('id'));
        }

        return Redirect::route('admin-emails')
                    ->with('messagetype', 'success')
                    ->with('message', 'The email has now been sent!');
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
        return response()->view('emails.show')->withEmail($email);
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
