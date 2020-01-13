<?php

namespace LANMS\Http\Controllers\Admin\Seating;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use LANMS\Http\Controllers\Controller;
use LANMS\Http\Requests\Admin\Seating\RowCreateRequest;
use LANMS\Http\Requests\Admin\Seating\RowEditRequest;
use LANMS\SeatRows;
use LANMS\TicketType;

class RowsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (!Sentinel::getUser()->hasAccess(['admin.seating.row.*'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $rows = SeatRows::withTrashed()->orderBy('sort_order', 'asc')->get();
        return view('seating.rows.index')->with('allrows', $rows);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (!Sentinel::getUser()->hasAccess(['admin.seating.row.create'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $ticket_types = TicketType::all();
        return view('seating.rows.create', ['ticket_types' => $ticket_types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(RowCreateRequest $request)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.seating.row.create'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $row = new SeatRows;
        $row->name = $request->name;
        $row->slug = strtolower($request->name);
        $row->editor_id = Sentinel::getUser()->id;
        $row->author_id = Sentinel::getUser()->id;
        $row->save();

        for ($i=0; $i < $request->seat_count; $i++) {
            $seat = new \LANMS\Seats;
            $seat->name = string($request->name.($i+1));
            $seat->slug = strtolower(string($request->name.($i+1)));
            $seat->row_id = $row->id;
            $seat->tickettype_id = $request->tickettype;
            $seat->save();
        }

        return Redirect::route('admin-seating-rows')
                ->with('messagetype', 'success')
                ->with('message', 'The row has now been created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.seating.row.update'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $row = SeatRows::withTrashed()->find($id);
        $ticket_types = TicketType::all();
        return view('seating.rows.edit', ['row' => $row, 'ticket_types' => $ticket_types]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, RowEditRequest $request)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.seating.row.update'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $row                = SeatRows::withTrashed()->find($id);
        $row->name          = $request->name;
        $row->slug          = strtolower($request->name);
        $row->editor_id     = Sentinel::getUser()->id;
        $row->save();

        if ($request->tickettype !== "nothing") {
            foreach ($row->seats as $seat) {
                $seat->tickettype_id = $request->tickettype;
                $seat->save();
            }
        }

        return Redirect::route('admin-seating-rows')
                ->with('messagetype', 'success')
                ->with('message', 'The row has now been saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.seating.row.destroy'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $row = SeatRows::find($id);
        $row->seats()->delete();
        if ($row->delete()) {
            return Redirect::route('admin-seating-rows')
                    ->with('messagetype', 'success')
                    ->with('message', 'The row and seats has now been deleted!');
        } else {
            return Redirect::route('admin-seating-rows')
                ->with('messagetype', 'danger')
                ->with('message', 'Something went wrong while deleting the row.');
        }
    }

    public function restore($id)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.seating.row.destroy'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $row = SeatRows::withTrashed()->find($id);
        $row->seats()->restore();
        if ($row->restore()) {
            return Redirect::route('admin-seating-rows')
                    ->with('messagetype', 'success')
                    ->with('message', 'The row and seats has now been restored!');
        } else {
            return Redirect::route('admin-seating-rows')
                ->with('messagetype', 'danger')
                ->with('message', 'Something went wrong while restoring the row.');
        }
    }
}
