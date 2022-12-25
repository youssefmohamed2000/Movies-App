<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read_admins')->only('index');
        $this->middleware('permission:create_admins')->only(['create', 'store']);
        $this->middleware('permission:update_admins')->only(['edit', 'update']);
        $this->middleware('permission:delete_admins')->only('delete');
    }

    public function index()
    {
        $admins = User::role('admin')->get();
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        $roles = Role::query()->whereNotIn('name', ['super_admin', 'admin', 'user'])->get();
        return view('admin.admins.create', compact('roles'));
    }

    public function store(StoreAdminRequest $request)
    {
        $validated = $request->safe();
        $validated['password'] = Hash::make($validated['password']);

        $admin = User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'type' => 'admin',
        ]);
        $admin->syncRoles(['admin', $validated['role_id']]);

        session()->flash('success', 'Admin Added Successfully');
        return redirect()->route('admin.admins.index');

    }

    public function edit(User $admin)
    {
        $roles = Role::query()->whereNotIn('name', ['super_admin', 'admin', 'user'])->get();
        return view('admin.admins.edit', compact('admin', 'roles'));
    }


    public function update(UpdateAdminRequest $request, User $admin)
    {
        $validated = $request->safe();

        $admin->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);
        $admin->syncRoles(['admin', $validated['role_id']]);

        session()->flash('success', 'Admin Updated Successfully');
        return redirect()->route('admin.admins.index');
    }

    public function destroy(User $admin)
    {
        $admin->delete();

        session()->flash('error', 'Admin Deleted Successfully');
        return redirect()->route('admin.admins.index');
    }
}
