<?php

namespace LANMS\Http\Controllers\Crew;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Redirect;

use LANMS\CrewSkill;

use LANMS\Http\Requests\Admin\Crew\CrewSkillCreateRequest;
use LANMS\Http\Requests\Admin\Crew\CrewSkillEditRequest;

class CrewSkillController extends Controller
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
        if (Sentinel::getUser()->hasAccess(['admin.crew-skill.*'])) {
            $skills = CrewSkill::all();
            return view('crew.skill.index')
                        ->withSkills($skills);
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
        if (Sentinel::getUser()->hasAccess(['admin.crew-skill.create'])) {
            return view('crew.skill.create');
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
    public function store(CrewSkillCreateRequest $request)
    {
        if (Sentinel::getUser()->hasAccess(['admin.crew-skill.create'])) {
            $title = $request->get('title');
            $slug = $request->get('slug');
            if (!is_null($slug)) {
                $slug = str_slug($slug, '-');
            } else {
                $slug = str_slug($request->get('title'), '-');
            }

            $crewskill                  = new CrewSkill;
            $crewskill->title           = $title;
            $crewskill->slug            = $slug;
            $crewskill->icon            = $request->get('icon');
            $crewskill->class           = $request->get('class');
            $crewskill->author_id       = Sentinel::getUser()->id;
            $crewskill->editor_id       = Sentinel::getUser()->id;

            if ($crewskill->save()) {
                return Redirect::route('admin-crew-skill')
                        ->with('messagetype', 'success')
                        ->with('message', 'The skill has now been saved and published!');
            } else {
                return Redirect::route('admin-crew-skill-create')
                    ->with('messagetype', 'danger')
                    ->with('message', 'Something went wrong while saving the skill.');
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
        if (Sentinel::getUser()->hasAccess(['admin.crew-skill.update'])) {
            $crewskill = CrewSkill::find($id);
            return view('crew.skill.edit')->withSkill($crewskill);
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
    public function update($id, CrewSkillEditRequest $request)
    {
        if (Sentinel::getUser()->hasAccess(['admin.crew-skill.update'])) {
            $slug = $request->get('slug');
            if (!is_null($slug)) {
                $slug = str_slug($slug, '-');
            } else {
                $slug = str_slug($request->get('title'), '-');
            }
            
            $crewskill              = CrewSkill::find($id);
            $crewskill->title       = $request->get('title');
            $crewskill->slug        = $slug;
            $crewskill->icon        = $request->get('icon');
            $crewskill->class       = $request->get('class');
            $crewskill->editor_id   = Sentinel::getUser()->id;

            if ($crewskill->save()) {
                return Redirect::route('admin-crew-skill-edit', $id)
                        ->with('messagetype', 'success')
                        ->with('message', 'The skill has now been saved!');
            } else {
                return Redirect::route('admin-crew-skill-edit', $id)
                    ->with('messagetype', 'danger')
                    ->with('message', 'Something went wrong while saving the skill.');
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
        if (Sentinel::getUser()->hasAccess(['admin.crew-skill.destroy'])) {
            $crewskill              = CrewSkill::find($id);
            $crewskill->editor_id   = Sentinel::getUser()->id;
            $crewskill->save();
            if ($crewskill->delete()) {
                return Redirect::route('admin-crew-skill')
                        ->with('messagetype', 'success')
                        ->with('message', 'The skill has now been deleted!');
            } else {
                return Redirect::route('admin-crew-skill')
                    ->with('messagetype', 'danger')
                    ->with('message', 'Something went wrong while deleting the skill.');
            }
        } else {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
    }
}
