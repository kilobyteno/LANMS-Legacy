<?php

namespace LANMS\Http\Controllers\Page;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Redirect;

use LANMS\Page;

use LANMS\Http\Requests\Admin\Page\PageCreateRequest;
use LANMS\Http\Requests\Admin\Page\PageEditRequest;

class PagesController extends Controller
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
        if (Sentinel::getUser()->hasAccess(['admin.pages.*'])) {
            $pages = Page::withTrashed()->get();
            return view('pages.index')
                        ->withPages($pages);
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
        if (Sentinel::getUser()->hasAccess(['admin.pages.create'])) {
            return view('pages.create');
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
    public function store(PageCreateRequest $request)
    {
        if (Sentinel::getUser()->hasAccess(['admin.pages.create'])) {
            $active = false;
            if ($request->get('active') == "on") {
                $active = true;
            }

            $showinmenu = false;
            if ($request->get('showinmenu') == "on") {
                $showinmenu = true;
            }

            $slug = $request->get('slug');
            if (!is_null($slug)) {
                $slug = str_slug($slug, '-');
            } else {
                $slug = str_slug($request->get('title'), '-');
            }

            $page               = new Page;
            $page->title        = $request->get('title');
            $page->slug         = $slug;
            $page->content      = $request->get('content');
            $page->active       = $active;
            $page->showinmenu   = $showinmenu;
            $page->editor_id    = Sentinel::getUser()->id;
            $page->author_id    = Sentinel::getUser()->id;

            $pagesave       = $page->save();

            if ($pagesave) {
                return Redirect::route('admin-pages')
                        ->with('messagetype', 'success')
                        ->with('message', 'The page has now been saved and published!');
            } else {
                return Redirect::route('admin-pages-create')
                    ->with('messagetype', 'danger')
                    ->with('message', 'Something went wrong while saving the page.');
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
    public function show($slug)
    {
        $page = Page::where('slug', '=', $slug)->first();
        abort_unless($page, 404);
        return view('main.page')->withPage($page);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if (Sentinel::getUser()->hasAccess(['admin.pages.update'])) {
            $page = Page::find($id);
            return view('pages.edit')->withPage($page);
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
    public function update($id, PageEditRequest $request)
    {
        if (Sentinel::getUser()->hasAccess(['admin.pages.update'])) {
            $active = false;
            if ($request->get('active') == "on") {
                $active = true;
            }

            $showinmenu = false;
            if ($request->get('showinmenu') == "on") {
                $showinmenu = true;
            }

            $slug = $request->get('slug');
            if (!is_null($slug)) {
                $slug = str_slug($slug, '-');
            } else {
                $slug = str_slug($request->get('title'), '-');
            }
            
            $page               = Page::find($id);
            $page->title        = $request->get('title');
            $page->content      = $request->get('content');
            $page->slug         = $slug;
            $page->active       = $active;
            $page->showinmenu   = $showinmenu;
            $page->editor_id    = Sentinel::getUser()->id;

            if ($page->save()) {
                return Redirect::route('admin-pages-edit', $id)
                        ->with('messagetype', 'success')
                        ->with('message', 'The page has now been saved!');
            } else {
                return Redirect::route('admin-pages-edit', $id)
                    ->with('messagetype', 'danger')
                    ->with('message', 'Something went wrong while saving the page.');
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
        if (Sentinel::getUser()->hasAccess(['admin.pages.destroy'])) {
            $page = Page::find($id);
            if ($page->delete()) {
                return Redirect::route('admin-pages')
                        ->with('messagetype', 'success')
                        ->with('message', 'The page has now been deleted!');
            } else {
                return Redirect::route('admin-pages')
                    ->with('messagetype', 'danger')
                    ->with('message', 'Something went wrong while deleting the page.');
            }
        } else {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function restore($id)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.pages.restore'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }

        $page = Page::withTrashed()->find($id);
        if ($page->restore()) {
            return Redirect::route('admin-pages')
                    ->with('messagetype', 'success')
                    ->with('message', 'The page has now been restored!');
        } else {
            return Redirect::route('admin-pages')
                ->with('messagetype', 'danger')
                ->with('message', 'Something went wrong while restoring the page.');
        }
    }
}
