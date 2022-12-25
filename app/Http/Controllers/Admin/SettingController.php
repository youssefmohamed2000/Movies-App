<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:read_settings')->only('general');
        $this->middleware('can:create_settings')->only('store');
    }

    public function general()
    {
        $settings = Setting::query()->first();
        return view('admin.settings.general', compact('settings'));
    }

    public function store(StoreSettingRequest $request)
    {
        $validated = $request->safe();

        $settings = Setting::query()->first();

        if ($request->hasFile('logo')) {
            if ($settings->logo) {
                Storage::disk('local')->delete('public/uploads/' . $settings->logo);
            }
            $request->file('logo')->store('public/uploads');
            $settings->logo = $request->file('logo')->hashName();
        }

        if ($request->hasFile('fav_icon')) {
            if ($settings->fav_icon) {
                Storage::disk('local')->delete('public/uploads/' . $settings->fav_icon);
            }
            $request->file('fav_icon')->store('public/uploads');
            $settings->fav_icon = $request->file('fav_icon')->hashName();
        }
        $settings->title = $validated['title'];
        $settings->description = $validated['description'];
        $settings->keywords = $validated['keywords'];
        $settings->email = $validated['email'];
        $settings->save();

        session()->flash('success', 'Settings Added Successfully');
        return redirect()->back();

    }

}
