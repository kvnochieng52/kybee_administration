<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Customer;
use App\Models\JobCard;
use App\Models\Loan;
use App\Models\LoanStatus;
use App\Models\Product;
use App\Models\SMS;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        return view('home')->with([
            'loan_pending_approval_stats' => Loan::where('loan_status_id', LoanStatus::PENDING_APPROVAL)->count(),
            'loan_overdue_stats' => Loan::where('due_date', '>', Carbon::now()->format("Y-m-d"))->count(),
            'loan_due_stats' => Loan::where('due_date', '=', Carbon::now()->format("Y-m-d"))->count(),
            'customers_stats' => User::leftJoin('model_has_roles', 'users.id', 'model_has_roles.model_id')
                ->where('model_has_roles.role_id', 1)
                ->count(),
            'loans_pending_requests' => Loan::getLoans()->where('loans.loan_status_id', LoanStatus::PENDING_APPROVAL)->select([
                'loans.*',
                'loan_statuses.loan_status_name',
                'repayment_statuses.repayment_status_name',
                'users.telephone',
                'user_details.first_name',
                'user_details.middle_name',
                'user_details.last_name',
            ])
                ->limit(5)
                ->get()

        ]);
    }
}
