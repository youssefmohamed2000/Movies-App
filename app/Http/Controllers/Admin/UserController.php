<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_users')->only('index');
        $this->middleware('permission:create_users')->only(['create', 'store']);
        $this->middleware('permission:update_users')->only(['edit', 'update']);
        $this->middleware('permission:delete_users')->only('delete');
    }

    public function index()
    {
        $users = User::query()->where('type', '=', 'user')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->safe();
        $validated['password'] = Hash::make($validated['password']);

        $user = User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'type' => 'user',
        ]);

        session()->flash('success', 'User Added Successfully');
        return redirect()->route('admin.users.index');

    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }


    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->safe();

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);
        session()->flash('success', 'User Updated Successfully');
        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        session()->flash('error', 'User Deleted Successfully');
        return redirect()->route('admin.users.index');
    }
}
