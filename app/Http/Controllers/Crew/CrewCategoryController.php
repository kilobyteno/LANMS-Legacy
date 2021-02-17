<?php

namespace LANMS\Http\Controllers\Crew;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Redirect;

use LANMS\CrewCategory;

use LANMS\Http\Requests\Admin\Crew\CrewCategoryCreateRequest;
use LANMS\Http\Requests\Admin\Crew\CrewCategoryEditRequest;

class CrewCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function admin()
    {
        if (Sentinel::getUser()->hasAccess(['admin.crew-category.*'])) {
            $crewcategories = CrewCategory::all();
            return view('crew.category.index')
                        ->withCategories($crewcategories);
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
        if (Sentinel::getUser()->hasAccess(['admin.crew-category.create'])) {
            return view('crew.category.create');
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
    public function store(CrewCategoryCreateRequest $request)
    {
        if (Sentinel::getUser()->hasAccess(['admin.crew-category.create'])) {
            $title = $request->get('title');
            $slug = $request->get('slug');
            if (!is_null($slug)) {
                $slug = str_slug($slug, '-');
            } else {
                $slug = str_slug($request->get('title'), '-');
            }

            $crewcategory                   = new CrewCategory;
            $crewcategory->title            = $title;
            $crewcategory->slug             = $slug;
            $crewcategory->author_id        = Sentinel::getUser()->id;
            $crewcategory->editor_id        = Sentinel::getUser()->id;

            $newscategorysave               = $crewcategory->save();

            if ($newscategorysave) {
                return Redirect::route('admin-crew-category')
                        ->with('messagetype', 'success')
                        ->with('message', 'The category has now been saved and published!');
            } else {
                return Redirect::route('admin-crew-category-create')
                    ->with('messagetype', 'danger')
                    ->with('message', 'Something went wrong while saving the category.');
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
        if (Sentinel::getUser()->hasAccess(['admin.crew-category.update'])) {
            $crewcategory = CrewCategory::withTrashed()->find($id);
            return view('crew.category.edit')->withCategory($crewcategory);
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
    public function update($id, CrewCategoryEditRequest $request)
    {
        if (Sentinel::getUser()->hasAccess(['admin.crew-category.update'])) {
            $slug = $request->get('slug');
            if (!is_null($slug)) {
                $slug = str_slug($slug, '-');
            } else {
                $slug = str_slug($request->get('title'), '-');
            }
            
            $crewcategory               = CrewCategory::find($id);
            $crewcategory->title        = $request->get('title');
            $crewcategory->slug         = $slug;
            $crewcategory->editor_id    = Sentinel::getUser()->id;

            if ($crewcategory->save()) {
                return Redirect::route('admin-crew-category-edit', $id)
                        ->with('messagetype', 'success')
                        ->with('message', 'The category has now been saved!');
            } else {
                return Redirect::route('admin-crew-category-edit', $id)
                    ->with('messagetype', 'danger')
                    ->with('message', 'Something went wrong while saving the category.');
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
        if (Sentinel::getUser()->hasAccess(['admin.crew-category.destroy'])) {
            $crewcategory               = CrewCategory::find($id);
            $crewcategory->editor_id    = Sentinel::getUser()->id;
            $crewcategory->save();
            if ($crewcategory->delete()) {
                return Redirect::route('admin-crew-category')
                        ->with('messagetype', 'success')
                        ->with('message', 'The category has now been deleted!');
            } else {
                return Redirect::route('admin-crew-category')
                    ->with('messagetype', 'danger')
                    ->with('message', 'Something went wrong while deleting the category.');
            }
        } else {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
    }
}
