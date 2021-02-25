<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Dashboard\Traits\ModelsDefinition;
use Laratrust\Traits\LaratrustRoleTrait;
use Dashboard\Http\Controllers\Controller;

class UserRolesPermissionsController extends Controller
{
    use ModelsDefinition;
    use LaratrustRoleTrait;

    /**
     * Display the list of resources on the users sections
     *
     * @return void
     */
    public function index()
    {
        $users = $this->user::all();
        return view("dashboard::assets.users")->with('users', $users);
    }

    /**
     * Display the specified resource
     *
     * @param integer $id
     * @return void
     */
    public function show(Request $request)
    {
        $userName = explode("@", $request['users-search'])[1] ?? $request['users-search'];
        if(empty($userName))
            return redirect(route('dashboard.users'))->with([
                'notificationStatus' => 'error',
                'notificationMessage' => 'User does not exist.'
            ]);

        $user = $this->user::where('name', $userName)->first();
        if($user == null)
            return redirect(route('dashboard.users'))->with([
                'notificationStatus' => 'error',
                'notificationMessage' => 'User does not exist.'
            ]);

        return view("dashboard::assets.users")->with(['tabName' => 'users', 'data' => $user, 'viewUser' => true]);
    }

    /**
     * Add role(s) to a user
     *
     * @param int $id
     * @param array $roles
     * @return void
     */
    public function addRoles(Request $request)
    {
        $role = $this->role::findOrFail($request['roles']);
        $roleUsers = $this->user::whereRoleIs($role->name)->get();
        $roleUsersCount = $this->user::whereRoleIs($role->name)->count();

        if($request['userId'] == null)
            return view('dashboard::assets.roles')->with([
                'tabName' => 'roles',
                'data' => ['role' => $role, 'roleUsers' => $roleUsers, 'roleUsersCount' => $roleUsersCount],
                'viewRole' => true
            ]);

        $user = $this->user::findOrFail($request['userId']);
        $roles = $request['roles'];

        if ($user->hasRole($role->name))
            return view('dashboard::assets.roles')->with([
                'data' => ['role' => $role, 'roleUsers' => $roleUsers, 'roleUsersCount' => $roleUsersCount],
                'viewRole' => true,
                'errorMessage' => 'The user has already the role assigned.'
            ]);

        $user->attachRole($roles);

        return redirect(route('dashboard.roles'))->with([
            'notificationStatus' => 'success',
            'notificationMessage' => 'Role successfully assigned.'
        ]);
    }

    /**
     * Remove role(s) from a user
     *
     * @param int $id
     * @param array $roles
     * @return void
     */
    public function removeRoles(Request $request)
    {
        $role = $this->role::findOrFail($request['roles']);
        $roleUsers = $this->user::whereRoleIs($role->name)->get();

        $user = $this->user::findOrFail($request['userId']);
        $roles = $request['roles'];

        $user->detachRole($roles);

        return redirect(route('dashboard.roles'))->with([
            'notificationStatus' => 'success',
            'notificationMessage' => 'Role successfully removed.'
        ]);
    }

    /**
     * Add permission(s) to a user
     *
     * @param int $id
     * @param array $permissions
     * @return void
     */
    public function addPermissions(Request $request)
    {
        $permission = $this->permission::findOrFail($request['permissions']);
        $permissionUsers = $this->user::wherePermissionIs($permission->name)->get();

        if($request['userId'] == null)
            return view('dashboard::assets.permissions')->with([
                'data' => ['permission' => $permission, 'permissionUsers' => $permissionUsers],
                'viewPermission' => true
            ]);

        $user = $this->user::findOrFail($request['userId']);

        if ($user->can($permission->name))
            return view('dashboard::assets.permissions')->with([
                'data' => ['permission' => $permission, 'permissionUsers' => $permissionUsers],
                'viewPermission' => true,
                'errorMessage' => 'The user has already the permission assigned.'
            ]);

        $user->attachPermission($permission);

        return redirect(route('dashboard.permissions'))->with([
            'notificationStatus' => 'success',
            'notificationMessage' => 'Permission successfully assigned.'
        ]);
    }

    /**
     * Remove permission(s) from a user
     *
     * @return void
     */
    public function removePermissions(Request $request)
    {
        $permission = $this->permission::findOrFail($request['permissions']);

        $user = $this->user::findOrFail($request['userId']);
        $permissions = $request['permissions'];

        $user->detachPermission($permission);

        return redirect(route('dashboard.permissions'))->with([
            'notificationStatus' => 'success',
            'notificationMessage' => 'Permission successfully removed.'
        ]);
    }
}
