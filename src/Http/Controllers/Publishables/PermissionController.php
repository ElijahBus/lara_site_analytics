<?php

namespace App\Http\Controllers\Dashboard;

use App\Role;
use App\User;
use App\Permission;
use Illuminate\Http\Request;
use Dashboard\Traits\ModelsDefinition;
use App\Traits\Dashboard\ValidateRequest;
use Illuminate\Support\Facades\Validator;
use Dashboard\Http\Controllers\Controller;

class PermissionController extends Controller
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
        $users = $this->user::all();
        return view('dashboard::assets.permissions')->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => ['required', 'string', 'unique:permissions'],
            'display_name' => ['required', 'string'],
            'description' => ['nullable', 'max:200']
        ]);

        if ($validator->fails()) {
            return view('dashboard::assets.permissions')->withErrors($validator)->with('newPermissionFailed', true);
        }

        $newPermission = $this->permission::create([
            'name' => $request['name'],
            'display_name' => $request['display_name'],
            'description' => $request['description']
        ]);

        $permissionUser = $request['permission_user'];
        if ($permissionUser != null) {
            $user = $this->user::findOrFail($permissionUser);
            $user->attachPermission($newPermission);
        }

        return redirect(route('dashboard.permissions'))->with([
            'notificationStatus' => 'success',
            'notificationMessage' => 'Permission Successfully created.'
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
        $permission = $this->permission::findOrFail($id);
        if ($permission == null) {
            return redirect(route('dashboard.permissions'))->with([
                'notificationStatus' => 'error',
                'notificationMessage' => 'Permission does not exist.'
            ]);
        }

        $permissionUsers = $this->user::wherePermissionIs($permission->name)->get();

        return view('dashboard::assets.permissions')->with([
            'tabName' => 'permissions',
            'data' => ['permission' => $permission, 'permissionUsers' => $permissionUsers],
            'viewPermission' => true
        ]);
    }

    public function displayPermission(Request $request)
    {
        $permission = $this->permission::where('name', $request['permissions-search'])->first();
        if ($permission == null) {
            return redirect(route('dashboard.permissions'))->with([
                'notificationStatus' => 'error',
                'notificationMessage' => 'Permission does not exist.'
            ]);
        }

        $permissionUsers = $this->user::wherePermissionIs($permission->name)->get();

        return view('dashboard::assets.permissions')->with([
            'data' => ['permission' => $permission, 'permissionUsers' => $permissionUsers],
            'viewPermission' => true
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
        $permission = $this->permission::findOrFail($id);

        return view('dashboard::assets.permissions')->with([
            'tabName' => 'permissions',
            'data' => $permission,
            'editPermission' => true
        ]);
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
        $permission = $this->permission::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'edit_name' => ['required', 'string'],
            'edit_display_name' => ['required', 'string'],
            'edit_description' => ['nullable', 'max:200']
        ]);

        if ($validator->fails()) {
            return view('dashboard::assets.permissions')->withErrors($validator)->with([
                'updatePermissionFailed'=> true,
                'data' => $permission
            ]);
        }

        $permission->update([
            'name' => $request['edit_name'],
            'display_name' => $request['edit_display_name'],
            'description' => $request['edit_description']
        ]);

        return redirect(route('dashboard.permissions'))->with([
            'notificationStatus' => 'success',
            'notificationMessage' => 'Permission Successfully updated.'
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
        $permission = $this->permission::findOrFail($id);
        $permission->delete();

        return redirect(route('dashboard.permissions'))->with([
            'notificationStatus' => 'success',
            'notificationMessage' => 'Permission Successfully deleted.'
        ]);
    }
}
