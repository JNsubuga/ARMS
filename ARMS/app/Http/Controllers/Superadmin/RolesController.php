<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('superadmins.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('superadmins.roles.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3']
        ]);

        Role::create($formFields);
        return to_route('superadmin.roles.index')->with('success', 'Record Created Successfully!!');
    }

    public function edit($id)
    {
        $toUpdate = Role::where('id', $id)->first();
        $selectPermissions = Permission::all();
        return view('superadmins.roles.edit', [
            'toUpdate' => $toUpdate,
            'selectPermissions' => $selectPermissions
        ]);
    }

    public function update(Request $request, $id)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3']
        ]);
        Role::where('id', $id)->update($formFields);
        return to_route('superadmin.roles.index')->with('success', 'Record Updated Successfully!!');
    }

    public function grantPermission(Request $request, $id)
    {
        $role = Role::where('id', $id)->first();
        if ($role->hasPermissionTo($request->permission)) {
            return back()->with('error', 'Permission already granted to this Role!!');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('success', 'Permission granted successfully!!');
    }

    public function revokePermission($roleId, $permissionId)
    {
        $role = Role::where('id', $roleId)->first();
        $permission = Permission::where('id', $permissionId)->first();

        if ($role->hasPermissionTo($permission->name)) {
            $role->revokePermissionTo($permission->name);
            return back()->with('success', 'Permisson revoked successfully!!');
        }

        return back()->with('error', 'Permission was never granted to this role');
    }

    public function destroy($id)
    {
        Role::destroy($id);
        return to_route('superadmin.roles.index')->with('success', 'Record Deleted Successfully!!');
    }
}
