<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanDistribution;
use App\Models\Setting;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function dashboard_init(Request $request)
    {

        return [
            'success' => true,
            'loan_distributions' => LoanDistribution::where(['visible' => 1])->orderBy('order', 'DESC')->get(),
            'user_details' => UserDetail::getUserByID($request->input('user_id')),
            'currency' => Setting::where('code', 'CURRENCY')->where('active', 1)->first()->setting_value
        ];
    }
}
