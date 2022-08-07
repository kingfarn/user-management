<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;

class RolesController extends Controller
{
    public function index()
    {
        // access_only_admin();
       // check_user_permission('role.view');
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        // access_only_admin();
        check_user_permission('role.add');
        return view('roles.add-edit');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permissions' => 'required',
        ]);
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permissions'));

        return redirect()->route('roles.index')
            ->withSuccessMessage('Role Added');
    }

    public function edit($id)
    {
        //access_only_admin();
       // check_user_permission('role.edit');
        $role = Role::findOrFail($id);
        $permissions_data = $role->getPermissionNames();
        $permissions = [];
        foreach ($permissions_data as $permission) {
            $permissions[$permission] = $permission;
        }
        $data = [
            'id' => $role->id,
            'name' => $role->name,
        ];
        $data = array_merge($data, $permissions);
        return view('roles.add-edit', ['role' => $data]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permissions' => 'required',
        ]);
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permissions'));
        return redirect()->route('roles.index')
            ->withSuccessMessage('Role Updated');
    }

    public function destroy($id)
    {
        //  access_only_admin();
        check_user_permission('role.delete');
        $role = Role::findOrFail($id);

        if ($role->name == "Super Admin") {
            return redirect()->route('roles.index')->with('success', 'Cannot Be Deleted');
        }
        $role->delete();

        return redirect(
            url('roles')
        );
    }
}
