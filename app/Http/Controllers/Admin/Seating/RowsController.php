<?php

namespace LANMS\Http\Controllers\Admin\Seating;

use LANMS\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use LANMS\SeatRows;

use LANMS\Http\Requests\Admin\Seating\RowCreateRequest;
use LANMS\Http\Requests\Admin\Seating\RowEditRequest;

class RowsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (Sentinel::getUser()->hasAccess(['admin.seating.row.*'])) {
            $rows = SeatRows::withTrashed()->get();
            return view('seating.rows.index')
                        ->with('allrows', $rows);
        } else {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (Sentinel::getUser()->hasAccess(['admin.seating.row.create'])) {
            return view('seating.rows.create');
        } else {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(RowCreateRequest $request)
    {
        if (Sentinel::getUser()->hasAccess(['admin.seating.row.create'])) {
            $row                = new SeatRows;
            $row->name          = $request->name;
            $row->slug          = strtolower($request->name);
            $row->editor_id     = Sentinel::getUser()->id;
            $row->author_id     = Sentinel::getUser()->id;
            $row->save();

            for ($i=0; $i < $request->seat_count; $i++) {
                $seat = new \LANMS\Seats;
                $seat->name = string($request->name.($i+1));
                $seat->slug = strtolower(string($request->name.($i+1)));
                $seat->row_id = $row->id;
                $seat->save();
            }

            return Redirect::route('admin-seating-rows')
                    ->with('messagetype', 'success')
                    ->with('message', 'The row has now been created!');
        } else {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
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
        if (Sentinel::getUser()->hasAccess(['admin.seating.row.update'])) {
            $row = SeatRows::withTrashed()->find($id);
            return view('seating.rows.edit')->withRow($row);
        } else {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, RowEditRequest $request)
    {
        if (Sentinel::getUser()->hasAccess(['admin.seating.row.update'])) {
            $row                = SeatRows::withTrashed()->find($id);
            $row->name          = $request->name;
            $row->slug          = strtolower($request->name);
            $row->editor_id     = Sentinel::getUser()->id;
            $row->save();

            return Redirect::route('admin-seating-rows')
                    ->with('messagetype', 'success')
                    ->with('message', 'The row has now been saved!');
        } else {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (Sentinel::getUser()->hasAccess(['admin.seating.row.destroy'])) {
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
        } else {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
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
