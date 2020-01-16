<?php

namespace LANMS\Http\Controllers\Admin\Seating;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use LANMS\Http\Controllers\Controller;
use LANMS\Http\Requests\Admin\Seating\SeatCreateRequest;
use LANMS\Http\Requests\Admin\Seating\SeatEditRequest;
use LANMS\Seats;
use LANMS\TicketType;

class SeatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (!Sentinel::getUser()->hasAccess(['admin.seating.seat.*'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $seats = Seats::withTrashed()->get();
        return view('seating.seats.index')->with('allseats', $seats);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (!Sentinel::getUser()->hasAccess(['admin.seating.seat.create'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $ticket_types = TicketType::all();
        return view('seating.seats.create', ['ticket_types' => $ticket_types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(SeatCreateRequest $request)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.seating.seat.create'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }

        $seat = new Seats;
        $seat->name = $request->name;
        $seat->slug = str_slug($request->name);
        $seat->tickettype_id = $request->tickettype;
        $seat->editor_id = Sentinel::getUser()->id;
        $seat->author_id = Sentinel::getUser()->id;

        if ($seat->save()) {
            return Redirect::route('admin-seating-seats')
                    ->with('messagetype', 'success')
                    ->with('message', 'The seat has now been created!');
        } else {
            return Redirect::route('admin-seating-seat-create')
                ->with('messagetype', 'danger')
                ->with('message', 'Something went wrong while saving the seat.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.seating.seat.update'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $seat = Seats::withTrashed()->find($id);
        $ticket_types = TicketType::all();
        return view('seating.seats.edit', ['seat' => $seat, 'ticket_types' => $ticket_types]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, SeatEditRequest $request)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.seating.seat.update'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $seat = Seats::withTrashed()->find($id);
        $seat->name = $request->name;
        $seat->slug = str_slug($request->name);
        $seat->row_id = $request->row_id;
        $seat->tickettype_id = $request->tickettype;
        $seat->editor_id = Sentinel::getUser()->id;
        $seat->save();
        
        return Redirect::route('admin-seating-seats')
                ->with('messagetype', 'success')
                ->with('message', 'The seat has now been saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.seating.seat.destroy'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $seat = Seats::find($id);
        if ($seat->delete()) {
            return Redirect::route('admin-seating-seats')
                    ->with('messagetype', 'success')
                    ->with('message', 'The seat has now been deleted!');
        } else {
            return Redirect::route('admin-seating-seats')
                ->with('messagetype', 'danger')
                ->with('message', 'Something went wrong while deleting the seat.');
        }
    }

    public function restore($id)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.seating.seat.destroy'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $seat = Seats::withTrashed()->find($id);
        if ($seat->restore()) {
            return Redirect::route('admin-seating-seats')
                    ->with('messagetype', 'success')
                    ->with('message', 'The seat has now been restored!');
        } else {
            return Redirect::route('admin-seating-seats')
                ->with('messagetype', 'danger')
                ->with('message', 'Something went wrong while restoring the seat.');
        }
    }
}
