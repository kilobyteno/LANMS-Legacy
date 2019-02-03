<?php

namespace LANMS\Http\Controllers\Crew;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Redirect;

use LANMS\Crew;
use LANMS\CrewCategory;
use LANMS\Page;

use LANMS\Http\Requests\Admin\Crew\CrewCreateRequest;
use LANMS\Http\Requests\Admin\Crew\CrewEditRequest;

class CrewController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $crewcategories = CrewCategory::where('active', '=', 1)->get();
        return view('crew.index')->with('crewcategories', $crewcategories);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function admin()
    {
        if (Sentinel::getUser()->hasAccess(['admin.crew.*'])) {
            $crewassignment = Crew::thisYear()->get();
            return view('crew.index')
                        ->with('crewassignment', $crewassignment);
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
        if (Sentinel::getUser()->hasAccess(['admin.crew.*'])) {
            return view('crew.create');
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
    public function store(CrewCreateRequest $request)
    {
        if (Sentinel::getUser()->hasAccess(['admin.crew.create'])) {
            if (Crew::where('user_id', $request->get('user_id'))->count() > 0) {
                return Redirect::route('admin-crew')
                        ->with('messagetype', 'warning')
                        ->with('message', 'This user has already been added to the crew.');
            }

            $crew = Crew::create([
                'user_id' => $request->get('user_id'),
                'category_id' => $request->get('category_id'),
                'year' => \Setting::get('SEATING_YEAR'),
                'author_id' => Sentinel::getUser()->id,
                'editor_id' => Sentinel::getUser()->id,
            ]);
            
            $crew->skills()->attach($request->input('skills'));

            if ($crew) {
                return Redirect::route('admin-crew')
                        ->with('messagetype', 'success')
                        ->with('message', 'The crew has now been saved!');
            } else {
                return Redirect::route('admin-crew')
                    ->with('messagetype', 'danger')
                    ->with('message', 'Something went wrong while saving the crew.');
            }
        } else {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
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
        if (Sentinel::getUser()->hasAccess(['admin.crew.update'])) {
            $crew = Crew::find($id);
            return view('crew.edit')->withCrew($crew);
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
    public function update($id, CrewEditRequest $request)
    {
        if (Sentinel::getUser()->hasAccess(['admin.crew.update'])) {
            $crew               = Crew::find($id);
            $crew->category_id  = $request->get('category_id');
            $crew->editor_id    = Sentinel::getUser()->id;

            $crew->skills()->detach();
            $crew->skills()->attach($request->input('skills'));

            if ($crew->save()) {
                return Redirect::route('admin-crew-edit', $id)
                        ->with('messagetype', 'success')
                        ->with('message', 'The crew has now been saved!');
            } else {
                return Redirect::route('admin-crew-edit', $id)
                    ->with('messagetype', 'danger')
                    ->with('message', 'Something went wrong while saving the crew.');
            }
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
        if (Sentinel::getUser()->hasAccess(['admin.crew.destroy'])) {
            $crew               = Crew::find($id);
            $crew->editor_id    = Sentinel::getUser()->id;
            $crew->save();
            if ($crew->delete()) {
                return Redirect::route('admin-crew')
                        ->with('messagetype', 'success')
                        ->with('message', 'The crew has now been deleted!');
            } else {
                return Redirect::route('admin-crew')
                    ->with('messagetype', 'danger')
                    ->with('message', 'Something went wrong while deleting the crew.');
            }
        } else {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
    }
}
