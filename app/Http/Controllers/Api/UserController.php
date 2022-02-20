<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LoanDistribution;
use App\Models\SMS;
use App\Models\UserDetail;
use App\Models\UserLoanDistribution;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function login(Request $request)
    {

        $results = [];

        if (Auth::attempt(['telephone' => $request->input('telephone'), 'password' => $request->input('password')])) {
            $user_details = User::find(Auth::id());

            if ($user_details->is_active == 1) {

                if ($user_details->phone_verified == 1) {
                    $results["success"] = true;
                    $results["data"] = $user_details;
                    $results["message"] = "success";
                } else {
                    $results["success"] = false;
                    $results["data"] = [];
                    $results["message"] = "Your Phone Number is not verified. Please verify";
                }
            } else {
                $results["success"] = false;
                $results["data"] = [];
                $results["message"] = "Your account is not activated. Please contact us for assistance";
            }
        } else {
            $results["success"] = false;
            $results["data"] = [];
            $results["message"] = "Credentials do not march. Please check and Try again";
        }

        return $results;
    }


    public function register(Request $request)
    {
        $results = [];
        $user_check = User::where('telephone', $request->input('telephone'))->first();
        if (!empty($user_check)) {
            $results['success'] = false;
            $results['data'] = [];
            $results['message'] = "The telephone provided is registered. Please login/reset password";
        } else {

            $randomNumber = random_int(10000, 99999);

            $user = new User();
            $user->telephone = $request->input('telephone');
            $user->ext_phone = SMS::clean_phone_number($request->input('telephone'));
            $user->is_active = 1;
            $user->password = Hash::make($request->input('password'));
            //$user->email = 'the-email@example.com';
            $user->name = '<unspecified>';
            $user->verification_code = $randomNumber;
            $user->save();


            UserDetail::insert([
                'user_id' => $user->id,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);


            UserLoanDistribution::insert([
                'user_id' => $user->id,
                'loan_distribution_id' => LoanDistribution::where(['order' => 1, 'visible' => 1])->first()->id,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);


            DB::table('model_has_roles')->insert([
                'role_id' => Role::where('name', 'Customer')->first()->id,
                'model_type' => 'App\User',
                'model_id' => $user->id
            ]);
            $message = "KYBEE LOAN verification code is: {$randomNumber}";
            // SMS::send($request->input('telephone'), $message);

            $results['success'] = true;
            $results['data'] = User::find($user->id);
            $results['message'] = "Verification code sent. Verify Your account to continue";
        }

        return $results;
    }



    public function verify(Request $request)
    {

        $results = [];
        $user_check = User::where('telephone', $request->input('telephone'))
            ->where('verification_code', $request->input('verification_code'))
            ->first();


        if (!empty($user_check)) {
            $user_check->phone_verified = 1;
            $user_check->save();
            $results['success'] = true;
            $results['data'] = [];
            $results['message'] = "Account verified. Please login to continue";
        } else {
            $results['success'] = false;
            $results['data'] = [];
            $results['message'] = "Invalid Verification code";
        }

        return $results;
    }



    public function resend_verification(Request $request)
    {
        $results = [];
        $user_check = User::where('telephone', $request->input('telephone'))->first();

        if (!empty($user_check)) {
            $randomNumber = random_int(10000, 99999);

            $user_check->verification_code = $randomNumber;
            $user_check->save();

            $message = "KYBEE LOAN verification code is: {$randomNumber}";
            SMS::send($request->input('telephone'), $message);

            $results['success'] = true;
            $results['data'] = [];
            $results['message'] = "Verification code Resend.";
        } else {
            $results['success'] = false;
            $results['data'] = [];
            $results['message'] = "Invalid Phone No";
        }

        return $results;
    }
}
