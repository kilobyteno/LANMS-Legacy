<?php

namespace LANMS\Http\Controllers\Admin\Seating;

use LANMS\TicketType;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use LANMS\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class TicketTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Sentinel::getUser()->hasAccess(['admin.seating.tickettype.*'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $ticket_types = TicketType::withTrashed()->get();
        return view('seating.tickettype.index', ['ticket_types' => $ticket_types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Sentinel::getUser()->hasAccess(['admin.seating.tickettype.create'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        return view('seating.tickettype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|integer',
            'color' => 'required|regex:/[a-zA-Z0-9]{6}/',
            'image' => 'image|max:25000',
            'description' => '',
            'active' => '',
        ]);

        $active = false;
        if ($request->get('active') == "on") {
            $active = true;
        }

        
        $tickettype = new TicketType;
        $tickettype->name = $request->name;
        $tickettype->slug = str_slug($request->name);
        $tickettype->price = $request->price;
        $tickettype->color = $request->color;
        $tickettype->description = $request->description;
        $tickettype->active = $active;
        $tickettype->editor_id = Sentinel::getUser()->id;
        $tickettype->author_id = Sentinel::getUser()->id;

        $tickettype->save();
        
        if (!is_null($request->image)) {
            $image = $request->file('image');
            $filename = $tickettype->id . '.' . $image->getClientOriginalExtension();
            $path = public_path() . '/images/tickettype/' . $filename;
            $webpath = '/images/tickettype/' . $filename;
            Image::make($image->getRealPath())->fit(115)->save($path);
            $tickettype->image = $webpath;
        }

        $tickettype->save();
        
        return Redirect::route('admin-seating-tickettypes')
                        ->with('messagetype', 'success')
                        ->with('message', 'The ticket type has now been created!');
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
        if (!Sentinel::getUser()->hasAccess(['admin.seating.tickettype.update'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $tickettype = TicketType::withTrashed()->find($id);
        return view('seating.tickettype.edit', ['tickettype' => $tickettype]);
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
        if (!Sentinel::getUser()->hasAccess(['admin.seating.tickettype.update'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }

        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|integer',
            'color' => 'required|regex:/[a-zA-Z0-9]{6}/',
            'image' => 'nullable|image|max:25000',
            'description' => '',
            'active' => '',
        ]);

        $active = false;
        if ($request->get('active') == "on") {
            $active = true;
        }

        $tickettype = TicketType::withTrashed()->find($id);
        $tickettype->name = $request->name;
        $tickettype->slug = str_slug($request->name);
        $tickettype->price = $request->price;
        $tickettype->color = $request->color;
        $tickettype->description = $request->description;
        $tickettype->active = $active;
        $tickettype->editor_id = Sentinel::getUser()->id;
        $tickettype->author_id = Sentinel::getUser()->id;

        if (!is_null($request->image)) {
            $image = $request->file('image');
            $filename = $tickettype->id . '.' . $image->getClientOriginalExtension();
            $path = public_path() . '/images/tickettype/' . $filename;
            $webpath = '/images/tickettype/' . $filename;
            Image::make($image->getRealPath())->fit(115)->save($path);
            $tickettype->image = $webpath;
        }

        $tickettype->save();

        return Redirect::route('admin-seating-tickettypes')
                        ->with('messagetype', 'success')
                        ->with('message', 'The ticket type has now been saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.seating.tickettype.destroy'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $tickettype = TicketType::find($id);
        if ($tickettype->delete()) {
            return Redirect::route('admin-seating-tickettypes')
                    ->with('messagetype', 'success')
                    ->with('message', 'The tickettype has now been deleted!');
        } else {
            return Redirect::route('admin-seating-tickettypes')
                ->with('messagetype', 'danger')
                ->with('message', 'Something went wrong while deleting the tickettype.');
        }
    }

    public function restore($id)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.seating.tickettype.destroy'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $tickettype = TicketType::withTrashed()->find($id);
        if ($tickettype->restore()) {
            return Redirect::route('admin-seating-tickettypes')
                    ->with('messagetype', 'success')
                    ->with('message', 'The tickettype has now been restored!');
        } else {
            return Redirect::route('admin-seating-tickettypes')
                ->with('messagetype', 'danger')
                ->with('message', 'Something went wrong while restoring the tickettype.');
        }
    }
}
