<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('superadmins.permissions.index', compact('permissions'));
    }

    public function create()
    {

        return view('superadmins.permissions.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required']
        ]);

        Permission::create($formFields);
        return to_route('superadmin.permissions.index')->with('success', 'Record Created Successfully!!');
    }

    public function edit($id)
    {
        $toUpdate = Permission::where('id', $id)->first();
        $selectRoles = Role::all();
        return view('superadmins.permissions.edit', [
            'toUpdate' => $toUpdate,
            'selectRoles' => $selectRoles
        ]);
    }

    public function update(Request $request, $id)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3']
        ]);
        Permission::where('id', $id)->update($formFields);
        return to_route('superadmin.permissions.index')->with('success', 'Record Updated Successfully!!');
    }

    public function assignRole(Request $request, $id)
    {
        $permission = Permission::where('id', $id)->first();
        if ($permission->hasRole($request->role)) {
            return back()->with('error', 'Role already Assigned!!');
        }
        $permission->assignRole($request->role);
        return back()->with('success', 'Role Assigned Successfully!!');
    }

    public function removeRole($permissionId, $roleId)
    {
        $permission = Permission::where('id', $permissionId)->first();
        $role = Role::where('id', $roleId)->first();


        if ($permission->hasRole($role->name)) {
            $permission->removeRole($role->name);
            return back()->with('success', 'Role Removed Successfully!!');
        }

        return back()->with('error', 'Role Was Never Assigned To This Permission');
    }

    public function destroy($id)
    {
        Permission::destroy($id);
        return to_route('superadmin.permissions.index')->with('success', 'Record Deleted Successfully!!');
    }
}
