<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('admin.profile.edit');
    }

    public function update(ProfileRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if (auth()->user()->image != null) {
                Storage::disk('local')->delete('public/uploads/' . auth()->user()->image);
            }
            $request->file('image')->store('public/uploads');
            $validated['image'] = $request->file('image')->hashName();
        }
        auth()->user()->update($validated);
        session()->flash('success', 'Profile Updated Successfully');
        return redirect()->route('admin.home');
    }
}
