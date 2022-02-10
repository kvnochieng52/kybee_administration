<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function status($status_id)
    {


        return view('loans.status')->with([
            'loans' => Loan::getLoans()->where('loans.loan_status_id', $status_id)->select([
                'loans.*',
                'loan_statuses.loan_status_name',
                'repayment_statuses.repayment_status_name',
                'users.telephone',
                'user_details.first_name',
                'user_details.middle_name',
                'user_details.last_name',
            ])->paginate(2)
        ]);
    }
}
