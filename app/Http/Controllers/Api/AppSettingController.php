<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AppSettingController extends Controller
{
    public function terms_conditions_fetch()
    {
        $terms = Setting::where('code', Setting::TERMS_CODE)
            ->where('active', 1)
            ->first();
        return [
            "success" => true,
            "terms" => ($terms != null) ? $terms : []
        ];
    }


    public function get_settings(Request $request)
    {
        return [
            "success" => true,
            "data" => Setting::where(['code' => $request->input('code'), 'active' => 1])->first()
        ];
    }



    public function get_contact_details(Request $request)
    {
        return [
            "success" => true,
            "phone" => Setting::where(['code' => 'PHONE', 'active' => 1])->first()->setting_value,
            "watsapp" => Setting::where(['code' => 'WATSAPP', 'active' => 1])->first()->setting_value,
            "email" => Setting::where(['code' => 'EMAIL', 'active' => 1])->first()->setting_value,
        ];
    }


    public function test(Request $request)
    {
        return [
            "success" => true,
            "name" => "kevin",
        ];
    }
}
