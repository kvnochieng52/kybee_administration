<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    public static function calculateLoan($loan_distribution_id)
    {
        $loan = LoanDistribution::where('id', $loan_distribution_id)->first();
        $intrest_rates = InterestRate::where('active_rate', 1)->first();

        $total_loan_amount = round($loan->max_amount);
        $intrest = round($total_loan_amount * ($intrest_rates->interest_percentage / 100));
        $commission =  round($total_loan_amount * ($intrest_rates->commission_percentage / 100));

        $disbursed = $total_loan_amount - ($intrest + $commission);

        return [
            'total_loan_amount' => $total_loan_amount,
            'intrest' => $intrest,
            'commission' => $commission,
            'disbursed' => $disbursed,
            'application_date' => Carbon::now()->format("Y-m-d"),
            'due_date' => Carbon::now()->addDays($loan->period)->format("Y-m-d"),
            'application_date_formatted' => Carbon::now()->format("d-F-Y"),
            'due_date_formatted' => Carbon::now()->addDays($loan->period)->format("d-F-Y")
        ];
    }
}
