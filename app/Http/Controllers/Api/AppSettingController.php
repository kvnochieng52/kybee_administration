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
            'success' => true,
            'terms' => ($terms != null) ? $terms : []
        ];
    }
}
