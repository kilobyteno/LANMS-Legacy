<?php

namespace LANMS\Http\Controllers\Admin;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use LANMS\Http\Controllers\Controller;
use LANMS\User;
use Twilio\Exceptions\RestException;
use Twilio\Rest\Client as TwilioClient;
use Validator;

class SMSController extends Controller
{
    public function __construct()
    {
        $this->middleware('checktwilioenv');
        $this->twilio = new TwilioClient(env('TWILIO_SID'), env('TWILIO_TOKEN'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        abort_unless(Sentinel::getUser()->hasAccess(['admin.sms.*']), 403);
        try {
            $messages = $this->twilio->messages->read();
        } catch (RestException $e) {
            return Redirect::route('admin')->with('messagetype', 'danger')->with('message', "Twilio Error: ".$e->getMessage());
        }
        return view('sms.index')->withMessages($messages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        abort_unless(Sentinel::getUser()->hasAccess(['admin.sms.create']), 403);
        return view('sms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        abort_unless(Sentinel::getUser()->hasAccess(['admin.sms.create']), 403);
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'message' => 'required'
        ]);
        if (!$validator->passes()) {
            return Redirect::back()->withErrors($validator);
        }
        try {
            $user = User::find($request->input('user_id'));
            $lookup = $this->twilio->lookups->v1->phoneNumbers($user->phone)->fetch(array("countryCode" => $user->phone_country));
            $number = $lookup->phoneNumber;
            $message = $request->input('message');
            $this->twilio->messages->create(
                $number,
                [
                    'from' => env('TWILIO_FROM'),
                    'body' => $message,
                ]
            );
            return Redirect::route('admin-sms')
                            ->with('messagetype', 'success')
                            ->with('message', "SMS sent!");
        } catch (Exception $e) {
            return Redirect::route('admin-sms')->with('messagetype', 'danger')->with('message', "Twilio Error: ".$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
