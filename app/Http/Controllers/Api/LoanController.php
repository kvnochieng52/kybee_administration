<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanDistribution;
use App\Models\RepaymentStatus;
use App\Models\Setting;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LoanController extends Controller
{
    public function dashboard_init(Request $request)
    {

        $user_details = UserDetail::getUserByID($request->input('user_id'));

        UserDetail::where('user_id', $request->input('user_id'))->update([
            'current_location' => $request->input('current_location')
        ]);

        $active_loan = Loan::where('user_id', $request->input('user_id'))
            ->leftJoin('loan_statuses', 'loans.loan_status_id', 'loan_statuses.id')
            ->where('repayment_status_id', RepaymentStatus::OPEN)
            ->first([
                'loans.*',
                'loan_statuses.loan_status_name',
                'loan_statuses.description',
                'loan_statuses.color_code',
                'loan_statuses.id AS loan_status_id',
            ]);
        if (!empty($active_loan)) {
            $active_loan->total_amount_formatted =  number_format(round($active_loan->total_amount));
            $active_loan->application_date_formatted = Carbon::parse($active_loan->application_date)->format("d-F-Y");
            $active_loan->due_date_formatted = Carbon::parse($active_loan->due_date)->format("d-F-Y");
            $active_loan->balance_formatted =  number_format(round($active_loan->balance));
            $active_loan->amount_paid_formatted =  number_format(round($active_loan->amount_paid));
        }

        return response()->json([
            "success" => true,
            "loan_distributions" => LoanDistribution::where(['visible' => 1])->orderBy('order', 'DESC')->get(),
            "user_details" => $user_details,
            "currency" => Setting::where('code', 'CURRENCY')->where('active', 1)->first()->setting_value,
            "default_loan" => Loan::calculateLoan($user_details->loan_distribution_id),
            "active_loan" => !empty($active_loan) ? true : false,
            "active_loan_details" => $active_loan,
        ]);
    }


    public function calculate_loan(Request $request)
    {
        return [
            'success' => true,
            'loan_details' => Loan::calculateLoan($request->input('distribution_id'))
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


    public function repayment_details(Request $request)
    {

        return [
            'success' => true,
            'mpesa_paybill' => Setting::where(['code' => $request->input('code'), 'active' => 1])->first()->setting_value,
            'account_number' => UserDetail::getUserByID($request->input('user_id'))->telephone,
            'balance' => Loan::getLoanByID($request->input('loan_id'))->balance,
        ];
    }


    public function close_loan(Request $request)
    {

        Loan::where('id', $request->input('loan_id'))->update([
            'repayment_status_id' => RepaymentStatus::CLOSED,
            'updated_at' => Carbon::now()->toDateTimeString(),
            'updated_by' => $request->input('user_id'),
        ]);

        return [
            'success' => true,
        ];
    }
}
