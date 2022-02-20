<?php

namespace App\Http\Controllers;

use App\Models\LoanDisbursement;
use App\Models\LoanRepayment;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public static function loan_repayments(Request $request)
    {
        return view('transaction.loan_repayments')->with([
            'transactions' => LoanRepayment::orderBy('created_at', 'DESC')->get()
        ]);
    }


    public static function loan_disbursements(Request $request)
    {


        return view('transaction.loan_disbursements')->with([
            'transactions' => LoanDisbursement::orderBy('created_at', 'DESC')->get()
        ]);
    }
}
