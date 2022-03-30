<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{


    public function privacy_policy()
    {
        return view('settings.privacy_policy')->with([
            'privacy_policy' => Setting::where('code', Setting::PRIVACY_POLICY)->first()->setting_value,
        ]);
    }




    public function terms_conditions_web()
    {
        return view('settings.terms_conditions_web')->with([
            'terms' => Setting::where('code', Setting::TERMS_CODE)->first()->setting_value,
        ]);
    }

    public function terms_conditions(Request $request)
    {
        return view('settings.terms_conditions')->with([
            'terms' => Setting::where('code', Setting::TERMS_CODE)->first()->setting_value,
        ]);
    }

    public function configurations_get(Request $request)
    {
        return view('settings.configurations')->with([
            'configurations' => Setting::where('code', '!=', Setting::TERMS_CODE)->get(),
        ]);
    }


    public function edit($config_id)
    {
        return view('settings.configurations_edit')->with([
            'setting' => Setting::where('id', $config_id)->first(),
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'setting_name' => 'required',
            'setting_value' => 'required',
            'active' => 'required',
        ]);

        Setting::where('id', $request->input('setting_id'))->update([
            'setting_name' => $request->input('setting_name'),
            'setting_value' => $request->input('setting_value'),
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        return redirect('/settings/configurations_get')->with('success', 'Configuration updated Successfully');
    }


    public function terms_conditions_process(Request $request)
    {
        $this->validate($request, [
            'terms_conditions' => 'required',
        ]);

        Setting::where('code', Setting::TERMS_CODE)->update([
            'setting_value' => $request->input('terms_conditions'),
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        return back()->with('success', 'Terms & Conditions updated Successfully');
    }
}
