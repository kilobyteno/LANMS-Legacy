<?php

namespace LANMS\Http\Controllers\Admin;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Roles\EloquentRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use LANMS\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Sentinel::getUser()->hasAccess(['admin.role.*'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $roles = EloquentRole::all();
        return view('user.role.index')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Sentinel::getUser()->hasAccess(['admin.role.create'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $role = Sentinel::findRoleBySlug('superadmin');
        abort_unless($role, 501);
        return view('user.role.create')->with('role', $role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.role.create'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $request->validate([
            'name' => 'required|unique:roles|max:255',
            'permission-*' => 'accepted',
        ]);
        $slug = Str::slug($request->name);
        $role = Sentinel::getRoleRepository()->createModel()->create([
            'name' => $request->name,
            'slug' => $slug,
        ]);
        $superadmin = Sentinel::findRoleBySlug('superadmin');
        foreach ($superadmin->permissions as $key => $value) {
            $role->addPermission($key, false)->save();
        }
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'permission-') !== false) {
                $permission = str_replace('_', '.', str_replace('permission-', '', $key));
                $role->updatePermission($permission, true)->save();
            }
        }
        return Redirect::route('admin-role-edit', $slug)
                    ->with('messagetype', 'success')
                    ->with('message', 'The role has now been saved!');
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
        if (!Sentinel::getUser()->hasAccess(['admin.role.update'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $role = Sentinel::findRoleBySlug($id);
        abort_unless($role, 404);
        return view('user.role.edit')->with('role', $role);
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
        if (!Sentinel::getUser()->hasAccess(['admin.role.update'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $role = Sentinel::findRoleBySlug($id);
        abort_unless($role, 404);
        $request->validate([
            'name' => 'required|unique:roles,name,'.$role->id.',id|max:255',
            'permission-*' => 'accepted',
        ]);
        foreach ($role->permissions as $key => $value) {
            $role->updatePermission($key, false)->save();
        }
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'permission-') !== false) {
                $permission = str_replace('_', '.', str_replace('permission-', '', $key));
                $role->updatePermission($permission, true)->save();
            }
        }
        return Redirect::route('admin-role-edit', $id)
                    ->with('messagetype', 'success')
                    ->with('message', 'The role has now been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Sentinel::getUser()->hasAccess(['admin.role.update'])) {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
        $role = Sentinel::findRoleBySlug($id);
        if ($role->name === 'Super Administrators') {
            return Redirect::route('admin-roles')->with('messagetype', 'warning')
                                ->with('message', 'This role cannot be deleted.');
        }
        abort_unless($role, 404);
        EloquentRole::find($role->id)->delete();
        return Redirect::route('admin-roles')
                    ->with('messagetype', 'success')
                    ->with('message', 'The role has now been deleted!');
    }
}
