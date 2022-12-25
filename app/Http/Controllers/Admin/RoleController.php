<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read_roles')->only('index');
        $this->middleware('permission:create_roles')->only(['create', 'store']);
        $this->middleware('permission:update_roles')->only(['edit', 'update']);
        $this->middleware('permission:delete_roles')->only('delete');
    }

    public function index()
    {
        $roles = Role::all();
        $role = Role::query()->first();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(StoreRoleRequest $request)
    {
        $validated = $request->safe();

        $role = Role::create(['name' => $validated['name']]);
        $role->syncPermissions($validated['permissions']);

        session()->flash('success', 'Role Added Successfully');
        return redirect()->route('admin.roles.index');
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    public function update(Role $role, UpdateRoleRequest $request)
    {
        $validated = $request->safe();
        $role->update([
            'name' => $validated['name']
        ]);
        $role->syncPermissions($request->get('permissions'));

        session()->flash('success', 'Role Updated Successfully');
        return redirect()->route('admin.roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        session()->flash('error', 'Role Deleted Successfully');
        return redirect()->route('admin.roles.index');
    }
}
