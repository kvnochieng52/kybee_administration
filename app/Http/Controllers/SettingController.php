<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function terms_conditions(Request $request)
    {
        return view('settings.terms_conditions')->with([
            'terms' => Setting::where('code', Setting::TERMS_CODE)->first()->setting_value,
        ]);
    }


    public function terms_conditions_process(Request $request)
    {
        $this->validate($request, [
            'terms_conditions' => 'required',
        ]);

        Setting::where('code', Setting::TERMS_CODE)->update([
            'setting_value' => $request->input('terms_conditions'),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        return back()->with('success', 'Terms & Conditions updated Successfully');
    }
}
