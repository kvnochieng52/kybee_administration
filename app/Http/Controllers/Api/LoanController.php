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

        $user_details = UserDetail::getUserByID($request->input('user_id'));
        return [
            'success' => true,
            'loan_distributions' => LoanDistribution::where(['visible' => 1])->orderBy('order', 'DESC')->get(),
            'user_details' => $user_details,
            'currency' => Setting::where('code', 'CURRENCY')->where('active', 1)->first()->setting_value,
            'default_loan' => Loan::calculateLoan($user_details->loan_distribution_id),
        ];
    }


    public function calculate_loan(Request $request)
    {
        return [
            'success' => true,
            'loan_details' => Loan::calculateLoan($request->input('distribution_id')),
        ];
    }


    public function apply_loan(Request $request)
    {

        $result = [];

        $profile_details_complete = UserDetail::checkUserProfile($request->input('user_id'));

        if ($profile_details_complete) {

            $required_loan_limit = Loan::requiredLimit($request->input('user_id'), $request->input('loan_distribution_id'));
            if ($required_loan_limit) {

                $user_has_active_loan = Loan::checkForActiveLoan($request->input('user_id'));

                if ($user_has_active_loan) {
                    $result['success'] = false;
                    $result['error_code'] = 0;
                    $result['message'] = "You have an active Loan. Please Repay the loan to apply for another";
                } else {
                    Loan::process($request->input('user_id'), $request->input('loan_distribution_id'));
                    $result['success'] = true;
                    $result['error_code'] = 0;
                    $result['message'] = "Profile Completed.";
                }
            } else {
                $result['success'] = false;
                $result['error_code'] = 2;
                $result['message'] = "You are not qualified for this Loan Limit at the moment. Please try another limit";
            }
        } else {
            $result['success'] = false;
            $result['error_code'] = 1;
            $result['message'] = "Complete Profile to Apply for a loan.";
        }
        return $result;
    }
}
