<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanRepayment;
use App\Models\LoanStatus;
use App\Models\RepaymentStatus;
use Carbon\Carbon;
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
            ])->paginate(15)
        ]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('loans.edit')->with([
            'loan' => Loan::getLoanByID($id),
            'loan_statuses' => LoanStatus::WhereIn('id', [LoanStatus::APPROVED, LoanStatus::DECLINED, LoanStatus::PENDING_APPROVAL])->pluck('loan_status_name', 'id')

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'approve_decline' => 'required',
        ]);


        $loan = Loan::find($id);
        $loan->loan_status_id = $request->input('approve_decline');
        $loan->save();

        return redirect('loan/' . LoanStatus::PENDING_APPROVAL . '/status')->with('success', 'Details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pending_repayment()
    {
        return view('loans.pending_repayment')->with([
            'loans' => Loan::getLoans()->where('loans.repayment_status_id', RepaymentStatus::OPEN)
                ->where('loans.loan_status_id', LoanStatus::SENT)
                ->select([
                    'loans.*',
                    'loan_statuses.loan_status_name',
                    'repayment_statuses.repayment_status_name',
                    'users.telephone',
                    'user_details.first_name',
                    'user_details.middle_name',
                    'user_details.last_name',
                ])->paginate(15),
            'title' => 'Pending Payments',
            'REPAYMENT_CLOSED' => RepaymentStatus::CLOSED
        ]);
    }



    public function over_due()
    {
        return view('loans.pending_repayment')->with([
            'loans' => Loan::getLoans()->where('loans.repayment_status_id', RepaymentStatus::OPEN)
                ->where('loans.loan_status_id', LoanStatus::SENT)
                ->where('due_date', '<', Carbon::now()->format("Y-m-d"))
                ->select([
                    'loans.*',
                    'loan_statuses.loan_status_name',
                    'repayment_statuses.repayment_status_name',
                    'users.telephone',
                    'user_details.first_name',
                    'user_details.middle_name',
                    'user_details.last_name',
                ])->paginate(15),
            'title' => 'Overdue Loans',
            'REPAYMENT_CLOSED' => RepaymentStatus::CLOSED,
        ]);
    }


    public function due()
    {
        return view('loans.pending_repayment')->with([
            'loans' => Loan::getLoans()->where('loans.repayment_status_id', RepaymentStatus::OPEN)
                ->where('loans.loan_status_id', LoanStatus::SENT)
                ->where('due_date', '=', Carbon::now()->format("Y-m-d"))
                ->select([
                    'loans.*',
                    'loan_statuses.loan_status_name',
                    'repayment_statuses.repayment_status_name',
                    'users.telephone',
                    'user_details.first_name',
                    'user_details.middle_name',
                    'user_details.last_name',
                ])->paginate(15),
            'title' => 'Due Loans',
            'REPAYMENT_CLOSED' => RepaymentStatus::CLOSED
        ]);
    }


    public function paid()
    {
        return view('loans.pending_repayment')->with([
            'loans' => Loan::getLoans()->where('loans.repayment_status_id', RepaymentStatus::CLOSED)
                ->select([
                    'loans.*',
                    'loan_statuses.loan_status_name',
                    'repayment_statuses.repayment_status_name',
                    'users.telephone',
                    'user_details.first_name',
                    'user_details.middle_name',
                    'user_details.last_name',
                ])->paginate(15),
            'title' => 'Paid Loans',
            'REPAYMENT_CLOSED' => RepaymentStatus::CLOSED
        ]);
    }
}
