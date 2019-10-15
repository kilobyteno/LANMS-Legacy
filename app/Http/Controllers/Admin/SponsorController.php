<?php

namespace LANMS\Http\Controllers\Admin;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use LANMS\Http\Controllers\Controller;
use LANMS\Http\Requests\Admin\Sponsor\SponsorCreateRequest;
use LANMS\Http\Requests\Admin\Sponsor\SponsorEditRequest;
use LANMS\Sponsor;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sponsors = Sponsor::thisYear()->get();
        return view('sponsor.index')->with('sponsors', $sponsors);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function admin()
    {
        if (!Sentinel::getUser()->hasAccess(['admin.sponsor.*'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $sponsors = Sponsor::twoLastYears()->withTrashed()->orderBy('year', 'DESC')->get();
        return view('sponsor.index')->with('sponsors', $sponsors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (!Sentinel::getUser()->hasAccess(['admin.sponsor.create'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        return view('sponsor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(SponsorCreateRequest $request)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.sponsor.create'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }

        $image_light = $request->file('image_light');
        $image_dark = $request->file('image_dark');
        $name = $request->get('name');
        $cleanname = strtolower(str_replace(' ', '', $name));
        
        if ($image_light) {
            $filename = $cleanname . '_' . \Setting::get('SEATING_YEAR') . '_light.' . $image_light->getClientOriginalExtension();
            $path = public_path() . '/images/sponsor/' . $filename;
            $webpath_light = '/images/sponsor/' . $filename;
            Image::make($image_light->getRealPath())->fit(335, 90)->save($path);
        }
        
        if ($image_dark) {
            $filename = $cleanname . '_' . \Setting::get('SEATING_YEAR') . '_dark.' . $image_dark->getClientOriginalExtension();
            $path = public_path() . '/images/sponsor/' . $filename;
            $webpath_dark = '/images/sponsor/' . $filename;
            Image::make($image_dark->getRealPath())->fit(335, 90)->save($path);
        }

        $sponsor = new Sponsor;
        $sponsor->name = $name;
        $sponsor->url = $request->get('url');
        $sponsor->description = $request->get('description');
        $sponsor->sort_order = $request->get('sort_order');
        $sponsor->image_light = ($webpath_light) ? $webpath_light : '';
        $sponsor->image_dark = ($webpath_dark) ? $webpath_dark : '';
        $sponsor->year = \Setting::get('SEATING_YEAR');
        $sponsor->editor_id = Sentinel::getUser()->id;
        $sponsor->author_id = Sentinel::getUser()->id;

        if ($sponsor->save()) {
            return Redirect::route('admin-sponsor')
                    ->with('messagetype', 'success')
                    ->with('message', 'The sponsor has now been created!');
        } else {
            return Redirect::route('admin-sponsor-create')
                ->with('messagetype', 'danger')
                ->with('message', 'Something went wrong while saving the sponsor.');
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
        if (!Sentinel::getUser()->hasAccess(['admin.sponsor.update'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $sponsor = Sponsor::find($id);
        return view('sponsor.edit')->withSponsor($sponsor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, SponsorEditRequest $request)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.sponsor.create'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }

        $image_light = $request->file('image_light');
        $image_dark = $request->file('image_dark');
        $name = $request->get('name');
        $cleanname = strtolower(str_replace(' ', '', $name));
        
        if ($image_light) {
            $filename = $cleanname . '_' . \Setting::get('SEATING_YEAR') . '_light.' . $image_light->getClientOriginalExtension();
            $path = public_path() . '/images/sponsor/' . $filename;
            $webpath_light = '/images/sponsor/' . $filename;
            Image::make($image_light->getRealPath())->fit(335, 90)->save($path);
        }
        
        if ($image_dark) {
            $filename = $cleanname . '_' . \Setting::get('SEATING_YEAR') . '_dark.' . $image_dark->getClientOriginalExtension();
            $path = public_path() . '/images/sponsor/' . $filename;
            $webpath_dark = '/images/sponsor/' . $filename;
            Image::make($image_dark->getRealPath())->fit(335, 90)->save($path);
        }

        $sponsor                = Sponsor::find($id);
        $sponsor->name          = $name;
        $sponsor->url           = $request->get('url');
        $sponsor->description   = $request->get('description');
        $sponsor->sort_order    = $request->get('sort_order');
        $sponsor->image_light = ($webpath_light) ? $webpath_light : '';
        $sponsor->image_dark = ($webpath_dark) ? $webpath_dark : '';
        $sponsor->editor_id     = Sentinel::getUser()->id;

        if ($sponsor->save()) {
            return Redirect::route('admin-sponsor')
                    ->with('messagetype', 'success')
                    ->with('message', 'The sponsor has now been updated!');
        } else {
            return Redirect::route('admin-sponsor-create')
                ->with('messagetype', 'danger')
                ->with('message', 'Something went wrong while saving the sponsor.');
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
        if (!Sentinel::getUser()->hasAccess(['admin.sponsor.destroy'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $sponsor = Sponsor::find($id);
        if ($sponsor->delete()) {
            return Redirect::route('admin-sponsor')
                    ->with('messagetype', 'success')
                    ->with('message', 'The sponsor has now been deleted!');
        } else {
            return Redirect::route('admin-sponsor')
                ->with('messagetype', 'danger')
                ->with('message', 'Something went wrong while deleting the page.');
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
        if (!Sentinel::getUser()->hasAccess(['admin.sponsor.restore'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $sponsor = Sponsor::withTrashed()->find($id);
        if ($sponsor->restore()) {
            return Redirect::route('admin-sponsor')
                    ->with('messagetype', 'success')
                    ->with('message', 'The sponsor has now been deleted!');
        } else {
            return Redirect::route('admin-sponsor')
                ->with('messagetype', 'danger')
                ->with('message', 'Something went wrong while deleting the page.');
        }
    }

    /**
     * Duplicate the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function duplicate($id)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.sponsor.create'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $sponsor = Sponsor::withTrashed()->find($id);
        $dupe_sponsor = $sponsor->replicate();
        $dupe_sponsor->year = \Setting::get('SEATING_YEAR');

        if ($sponsor->image) {
            $filename = strtolower(str_replace(' ', '', $dupe_sponsor->name)) . '_' . \Setting::get('SEATING_YEAR') . '.' . File::extension(public_path() . $sponsor->image);
            $path = public_path() . $dupe_sponsor->image;
            $webpath = '/images/sponsor/' . $filename;
            $new_path = public_path() . $dupe_sponsor->image;
            File::copy($path, $new_path);
            $dupe_sponsor->image = $webpath;
        }

        $dupe_sponsor->save();
        return Redirect::route('admin-sponsor')
                ->with('messagetype', 'success')
                ->with('message', 'The sponsor has now been duplicated!');
    }
}
