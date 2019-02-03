<?php

namespace LANMS\Http\Controllers\News;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Redirect;

use LANMS\NewsCategory;

use LANMS\Http\Requests\Admin\News\NewsCategoryCreateRequest;
use LANMS\Http\Requests\Admin\News\NewsCategoryEditRequest;

class NewsCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        dd('News Categories');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function admin()
    {
        if (Sentinel::getUser()->hasAccess(['admin.newscategory.*'])) {
            $newscategories = NewsCategory::all();
            return view('news.category.index')
                        ->withCategories($newscategories);
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
        if (Sentinel::getUser()->hasAccess(['admin.newscategory.create'])) {
            return view('news.category.create');
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
    public function store(NewsCategoryCreateRequest $request)
    {
        if (Sentinel::getUser()->hasAccess(['admin.newscategory.create'])) {
            $name = $request->get('name');
            $slug = $request->get('slug');
            if (!is_null($slug)) {
                $slug = str_slug($slug, '-');
            } else {
                $slug = str_slug($request->get('name'), '-');
            }

            $newscategory                   = new NewsCategory;
            $newscategory->name             = $name;
            $newscategory->slug             = $slug;
            $newscategory->creator_id       = Sentinel::getUser()->id;
            $newscategory->author_id        = Sentinel::getUser()->id;

            $newscategorysave               = $newscategory->save();

            if ($newscategorysave) {
                return Redirect::route('admin-news-category')
                        ->with('messagetype', 'success')
                        ->with('message', 'The category has now been saved and published!');
            } else {
                return Redirect::route('admin-news-category-create')
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
        return Redirect::back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if (Sentinel::getUser()->hasAccess(['admin.newscategory.update'])) {
            $newscategory = NewsCategory::find($id);
            return view('news.category.edit')->withCategory($newscategory);
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
    public function update($id, NewsCategoryEditRequest $request)
    {
        if (Sentinel::getUser()->hasAccess(['admin.newscategory.update'])) {
            $slug = $request->get('slug');
            if (!is_null($slug)) {
                $slug = str_slug($slug, '-');
            } else {
                $slug = str_slug($request->get('title'), '-');
            }

            $newscategory               = NewsCategory::find($id);
            $newscategory->name         = $request->get('name');
            $newscategory->slug         = $slug;
            $newscategory->author_id    = Sentinel::getUser()->id;

            if ($newscategory->save()) {
                return Redirect::route('admin-news-category-edit', $id)
                        ->with('messagetype', 'success')
                        ->with('message', 'The category has now been saved!');
            } else {
                return Redirect::route('admin-news-category-edit', $id)
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
        if (Sentinel::getUser()->hasAccess(['admin.newscategory.destroy'])) {
            $newscategory = NewsCategory::find($id);
            if ($newscategory->delete()) {
                return Redirect::route('admin-news-category')
                        ->with('messagetype', 'success')
                        ->with('message', 'The category has now been deleted!');
            } else {
                return Redirect::route('admin-news-category')
                    ->with('messagetype', 'danger')
                    ->with('message', 'Something went wrong while deleting the category.');
            }
        } else {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
    }
}
