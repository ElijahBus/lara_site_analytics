<?php

namespace App\Http\Controllers\Dashboard;

use App\Role;
use App\User;
use App\Permission;
use Dashboard\Facades\Model;
use Illuminate\Http\Request;
use Dashboard\Traits\ModelsDefinition;
use App\Traits\Dashboard\ValidateRequest;
use Illuminate\Support\Facades\Validator;
use Dashboard\Http\Controllers\Controller;

class RoleController extends Controller
{
    use ModelsDefinition;
    use ValidateRequest;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->role::all();
        $users = $this->user::all();
        return view('dashboard::assets.roles')->with(['roles' => $roles, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:roles'],
            'display_name' => ['required', 'string'],
            'description' => ['nullable', 'max:200']
        ]);

        if ($validator->fails())
            return view('dashboard::assets.roles')->withErrors($validator)->with('newRoleFailed', true);

        $newRole = $this->role::create([
            'name' => $request['name'],
            'display_name' => $request['display_name'],
            'description' => $request['description']
        ]);

        $roleUser = $request['role_user'];
        if ($roleUser != null) {
            $user = $this->user::findOrFail($roleUser);
            $user->attachRole($newRole);
        }

        return redirect(route('dashboard.roles'))->with([
            'notificationStatus' => 'success',
            'notificationMessage' => 'Role Successfully created.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->role::findOrFail($id);
        if ($role == null) {
            return redirect(route('dashboard.roles'))->with([
                'notificationStatus' => 'error',
                'notificationMessage' => 'Role does not exist.'
            ]);
        }

        $roleUsers = $this->user::whereRoleIs($role->name)->get();
        $roleUsersCount = $this->user::whereRoleIs($role->name)->count();

        return view('dashboard::assets.roles')->with([
            'tabName' => 'roles',
            'data' => ['role' => $role, 'roleUsers' => $roleUsers, 'roleUsersCount' => $roleUsersCount],
            'viewRole' => true
        ]);
    }

    public function displayRole(Request $request)
    {
        $role = $this->role::where('name', $request['roles-search'])->first();
        if ($role == null) {
            return redirect(route('dashboard.roles'))->with([
                'notificationStatus' => 'error',
                'notificationMessage' => 'Role does not exist.'
            ]);
        }

        $roleUsers = $this->user::whereRoleIs($role->name)->get();
        $roleUsersCount = $this->user::whereRoleIs($role->name)->count();

        return view('dashboard::assets.roles')->with([
            'tabName' => 'roles',
            'data' => ['role' => $role, 'roleUsers' => $roleUsers, 'roleUsersCount' => $roleUsersCount],
            'viewRole' => true
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editRole = $this->role::findOrFail($id);

        return view('dashboard::assets.roles')->with(['tabName' => 'roles', 'data' => $editRole, 'editRole' => true]);
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
        $role = $this->role::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'edit_name' => ['required', 'string'],
            'edit_display_name' => ['required', 'string'],
            'edit_description' => ['nullable', 'max:200']
        ]);

        if ($validator->fails())
            return view('dashboard::assets.roles')->withErrors($validator)->with([
                'updateRoleFailed'=> true,
                'data' => $role
                ]);

        $role->update([
            'name' => $request['edit_name'],
            'display_name' => $request['edit_display_name'],
            'description' => $request['edit_description']
        ]);

        return redirect(route('dashboard.roles'))->with([
            'notificationStatus' => 'success',
            'notificationMessage' => 'Role Successfully updated.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = $this->role::findOrFail($id);
        $role->delete();

        return redirect(route('dashboard.roles'))->with([
            'notificationStatus' => 'success',
            'notificationMessage' => 'Role successfully deleted.'
        ]);
    }

    /**
     * Add permission(s) to a role
     *
     * @param App\Role $role
     * @param array $permissions
     * @return void
     */
    public function addPermissions(Request $request)
    {
        $role = $this->role::findOrFail($request['roleId']);
        $role->attachPermissions($request['permissions']);

        return "permission attached";
    }

    /**
     * Remove permission(s) from a role
     *
     * @param App\Role $role
     * @param array $permissions
     * @return void
     */
    public function removePermissions(Request $request)
    {
        $role = $this->role::findOrFail($request['roleId']);
        $role->detachPermissions($request['permissions']);

        return "permission dettached";

    }
}
