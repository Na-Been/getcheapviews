<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function changeMode()
    {
        $setting = Setting::first();
        if ($setting) {
            if ($setting->mode_status == 0) {
                $setting->mode_status = 1;
            } else {
                $setting->mode_status = 0;
            }
            $setting->save();
            return redirect()->back()->with('notify', 'Theme Change Successfully');
        } else {
            return redirect()->back()->with('notify', 'Theme Cannot Be change Please Add Setting First');
        }
    }

    public function create()
    {
        return view('admin.setting.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'short_name' => 'required',
            'contact' => 'required',
            'address' => 'required',
            'email' => 'required',
            'description' => 'required',
        ]);
        if ($request->hasFile('logo')) {
            $this->validate($request, [
                'logo' => 'required',
                'logo.*' => 'mimes:jpeg,png,jpg,gif,svg,bmp,tif,tiff,eps,webp'
            ]);
        }
        try {
            DB::beginTransaction();
            $setting = Setting::first();
            $input = $request->all();
            if ($request->hasFile('logo')) {
                $input['logo'] = $request->logo->store('public/setting');
            }
            if ($setting) {
                if ($request->hasFile('logo')) {
                    Storage::delete($setting->logo);
                    $input['logo'] = $request->logo->store('public/setting');
                }
                $setting->update($input);
            } else {
                Setting::create($input);
            }
            DB::commit();
            return redirect()->route('setting.create')->with('success', 'Setting Added Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('setting.create')->with('failed', 'Something Went Wrong While Adding Setting');
        }

    }
}
