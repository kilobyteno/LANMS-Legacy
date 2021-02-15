<?php

namespace LANMS\Http\Controllers\Seating;

use Authy\AuthyApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use LANMS\Checkin;
use LANMS\Http\Controllers\Controller;
use LANMS\SeatTicket;

class SelfCheckinController extends Controller
{
    public function __construct()
    {
        $this->authyApi = new AuthyApi(env('AUTHY_API_KEY'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('seating.checkin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->get('id');
        $ticket = SeatTicket::where('code', $id)->first();
        if (!$ticket) {
            return Redirect::route('seating-checkin')->with('messagetype', 'warning')
                                ->with('message', __('seating.checkin.alert.notfound'));
        }
        return Redirect::route('seating-checkin-show', $id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = SeatTicket::where('code', $id)->first();
        if (!$ticket) {
            return Redirect::route('seating-checkin')->with('messagetype', 'warning')
                                ->with('message', __('seating.checkin.alert.notfound'));
        }
        if (!$ticket->reservation->payment || $ticket->user->age() < 15 || !$ticket->user->phone_verified_at) {
            return Redirect::route('seating-checkin')->with('messagetype', 'warning')
                                ->with('message', __('seating.checkin.alert.notallowed'));
        }
        if ($ticket->checkin) {
            return Redirect::route('seating-checkin')->with('messagetype', 'warning')
                                ->with('message', __('seating.checkin.alert.alreadycheckedin'));
        }

        return response()->view('seating.checkin.show')->withTicket($ticket);
    }

    /**
     * Request phone verification via PhoneVerificationService.
     *
     * @param  array  $data
     * @return Illuminate\Support\Facades\Response;
     */
    public function startVerification(Request $request)
    {
        $id = $request->get('id');
        $ticket = SeatTicket::where('code', $id)->first();
        if (!$ticket) {
            return Redirect::route('seating-checkin')->with('messagetype', 'warning')
                                ->with('message', __('seating.checkin.alert.notfound'));
        }
        if (!$ticket->reservation->payment || $ticket->user->age() < 15 || !$ticket->user->phone_verified_at) {
            return Redirect::route('seating-checkin')->with('messagetype', 'warning')
                                ->with('message', __('seating.checkin.alert.notallowed'));
        }
        if (is_null($ticket->user->phone) && is_null($ticket->user->phone_country)) {
            return Redirect::route('seating-checkin')
                            ->with('messagetype', 'warning')
                            ->with('message', __('seating.checkin.alert.nophone'));
        }
        try {
            $response = $this->authyApi->phoneVerificationStart($ticket->user->phone, \libphonenumber\PhoneNumberUtil::getInstance()->getCountryCodeForRegion(strtoupper($ticket->user->phone_country)), 'sms');
            if ($response->ok()) {
                return Redirect::route('seating-checkin-show', $id);
            } else {
                return Redirect::route('seating-checkin')
                        ->with('messagetype', 'danger')
                        ->with('message', __('seating.checkin.alert.failed').' '.$response->message());
            }
        } catch (Exception $e) {
            return Redirect::route('seating-checkin')
                    ->with('messagetype', 'danger')
                    ->with('message', __('seating.checkin.alert.failed').' '.$e->getMessage());
        }
    }

    /**
     * Request phone verification via PhoneVerificationService.
     *
     * @param  array  $data
     * @return Illuminate\Support\Facades\Response;
     */
    public function verifyCode(Request $request)
    {
        $id = $request->get('id');
        $ticket = SeatTicket::where('code', $id)->first();
        if (!$ticket) {
            return Redirect::route('seating-checkin')->with('messagetype', 'warning')
                                ->with('message', __('seating.checkin.alert.notfound'));
        }
        if (!$ticket->reservation->payment || $ticket->user->age() < 15 || !$ticket->user->phone_verified_at) {
            return Redirect::route('seating-checkin')->with('messagetype', 'warning')
                                ->with('message', __('seating.checkin.alert.notallowed'));
        }
        if (is_null($ticket->user->phone) && is_null($ticket->user->phone_country)) {
            return Redirect::route('seating-checkin')
                            ->with('messagetype', 'warning')
                            ->with('message', __('seating.checkin.alert.nophone'));
        }
        $data = $request->all();
        $validator = Validator::make($data, [
            'code' => 'required|string|max:10',
            'id' => '',
        ]);
        extract($data);
        if ($validator->passes()) {
            try {
                $response = $this->authyApi->phoneVerificationCheck($ticket->user->phone, \libphonenumber\PhoneNumberUtil::getInstance()->getCountryCodeForRegion(strtoupper($ticket->user->phone_country)), $code, \App::getLocale());
                if ($response->ok()) {
                    //
                    // DO CHECKIN SHIT HERE
                    //
                    $checkin                    = new Checkin;
                    $checkin->ticket_id         = $ticket->id;
                    $checkin->bandnumber        = $ticket->barcode;
                    $checkin->year              = \Setting::get('SEATING_YEAR');
                    $checkin->save();

                    $ticket                     = SeatTicket::find($ticket->id);
                    $ticket->checkin_id         = $checkin->id;
                    $ticket->save();
                    //
                    //
                    //
                    return Redirect::route('seating-checkin')
                        ->with('messagetype', 'success')
                        ->with('message', __('seating.checkin.alert.success'));
                } else {
                    return Redirect::back()
                                    ->with('messagetype', 'danger')
                                    ->with('message', $response->message());
                }
            } catch (Exception $e) {
                return Redirect::route('seating-checkin')
                        ->with('messagetype', 'danger')
                        ->with('message', __('seating.checkin.alert.failed').' '.$e->getMessage());
            }
        } else {
            return Redirect::back()->withErrors();
        }
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
