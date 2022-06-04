<?php

namespace App\Models;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    public static function calculateLoan($loan_distribution_id)
    {
        $loan = LoanDistribution::where('id', $loan_distribution_id)->first();
        $intrest_rates = InterestRate::where('active_rate', 1)->first();

        $total_loan_amount = round($loan->max_amount);

        $intrest = $total_loan_amount * ($intrest_rates->interest_percentage / 100) / (365 * 90);
        $commission =  round($total_loan_amount * ($intrest_rates->commission_percentage / 100));

        $disbursed = $total_loan_amount + ($intrest + $commission);

        return [
            "total_loan_amount" => $total_loan_amount,
            "intrest" => $intrest,
            "commission" => $commission,
            "disbursed" => $disbursed,

            "total_loan_amount_formatted" => number_format($total_loan_amount),
            "intrest_formatted" => number_format($intrest),
            "commission_formatted" => number_format($commission),
            "disbursed_formatted" => number_format($disbursed),

            "application_date" => Carbon::now()->format("Y-m-d"),
            "due_date" => Carbon::now()->addDays($loan->period)->format("Y-m-d"),
            "application_date_formatted" => Carbon::now()->format("d-F-Y"),
            "due_date_formatted" => Carbon::now()->addDays($loan->period)->format("d-F-Y"),
            "loan_details" => $loan,
        ];
    }

    public static function requiredLimit($user_id, $loan_distribution_id)
    {
        $user_details = UserDetail::getUserByID($user_id);

        $user_loan_limit = LoanDistribution::find($user_details->loan_distribution_id);
        $loan_trying_to_apply = LoanDistribution::find($loan_distribution_id);

        if ($loan_trying_to_apply->order <= $user_loan_limit->order) {
            return true;
        } else {
            return false;
        }
    }


    public static function process($user_id, $loan_distribution_id)
    {
        $loan_details = self::calculateLoan($loan_distribution_id);

        $loan = new Loan();
        $loan->user_id = $user_id;
        $loan->loan_distribution_id = $loan_distribution_id;
        $loan->total_amount = $loan_details['total_loan_amount'];
        $loan->disbursed = $loan_details['disbursed'];
        $loan->interest = $loan_details['intrest'];
        $loan->commission = $loan_details['commission'];
        $loan->amount_paid = 0;
        $loan->balance = $loan_details['total_loan_amount'];
        $loan->application_date = $loan_details['application_date'];
        $loan->due_date = $loan_details['due_date'];
        $loan->repayment_status_id = RepaymentStatus::OPEN;
        $loan->loan_status_id = LoanStatus::PENDING_APPROVAL;
        $loan->created_by = $user_id;
        $loan->updated_by = $user_id;
        $loan->save();
    }


    public static function checkForActiveLoan($user_id)
    {
        $check = Loan::where([
            'user_id' => $user_id,
            'repayment_status_id' => RepaymentStatus::OPEN,
        ])->first();

        if (!empty($check)) {
            return true;
        } else {
            return false;
        }
    }


    public static function getLoans()
    {
        return self::leftJoin('loan_statuses', 'loans.loan_status_id', 'loan_statuses.id')
            ->leftJoin('repayment_statuses', 'loans.repayment_status_id', 'repayment_statuses.id')
            ->leftJoin('users', 'loans.user_id', 'users.id')
            ->leftJoin('user_details', 'loans.user_id', 'user_details.user_id');
    }

    public static function getLoanByID($ID)

    {

        return self::leftJoin('loan_statuses', 'loans.loan_status_id', 'loan_statuses.id')
            ->leftJoin('repayment_statuses', 'loans.repayment_status_id', 'repayment_statuses.id')
            ->leftJoin('users', 'loans.user_id', 'users.id')
            ->leftJoin('user_details', 'loans.user_id', 'user_details.user_id')
            ->where('loans.id', $ID)
            ->first([
                'loans.*',
                'loan_statuses.loan_status_name',
                'repayment_statuses.repayment_status_name',
                'users.telephone',
                'user_details.first_name',
                'user_details.middle_name',
                'user_details.last_name',
            ]);
    }
}
