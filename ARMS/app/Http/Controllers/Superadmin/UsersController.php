<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'edit', 'destroy']);
        // function __construct()
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->filter(request(['search']))->paginate();
        return view('superadmins.users.index', ['users' => $users]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $toDetail = User::where('id', $id)->first();
        $selectRoles = Role::all();
        $selectPermissions = Permission::all();
        return view('superadmins.users.role', [
            'toDetail' => $toDetail,
            'selectRoles' => $selectRoles,
            'selectPermissions' => $selectPermissions
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function assignRole(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        if ($user->hasRole($request->role)) {
            return back()->with('error', 'Role already assign to this User!!!');
        }

        $user->assignRole($request->role);
        return back()->with('success', 'Role assigned successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeRole($id, $roleid)
    {
        $user = User::where('id', $id)->first();
        $role = Role::where('id', $roleid)->first();
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back()->with('success', 'Role Removed Successfully!!');
        }
        return back()->with('error', 'Role never been assigned to this user!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function grantPermission(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        if ($user->hasPermissionTo($request->permission)) {
            return back()->with('error', 'Permission already Granted!!!');
        }

        $user->givePermissionTo($request->permission);
        return back()->with('success', 'Perission Ganted Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function revokePermission($id, $roleid)
    {
        $user = User::where('id', $id)->first();
        $permission = Permission::where('id', $roleid)->first();

        if ($user->hasPermissionTo($permission)) {
            $user->revokePermissionTo($permission);
            return back()->with('success', 'Permission Revoked Successfully!!');
        }
        return back()->with('error', 'Permission Was Never Granted To This User!!!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        if ($user->hasRole('SuperAdmin')) {
            return back()->with('error', 'User can not be deleted!!!');
        }

        User::destroy($id);
        return back()->with('success', 'User Deleted Successfully!!');
    }
}
