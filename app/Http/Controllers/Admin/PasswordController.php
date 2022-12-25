<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('admin.profile.password.edit');
    }

    public function update(PasswordRequest $request)
    {
        $validated = $request->validated();
        auth()->user()->update([
            'password' => Hash::make($validated['password'])
        ]);
        session()->flash('success', 'Password Updated Successfully');
        return redirect()->route('admin.home');
    }
}
