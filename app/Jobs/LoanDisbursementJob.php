<?php

namespace App\Jobs;

use App\Models\Loan;
use App\Models\LoanStatus;
use App\Models\MpesaAPI;
use App\Models\SMS;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LoanDisbursementJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $loan_status_id = LoanStatus::APPROVED;
        $active_loans = Loan::where('loan_status_id', $loan_status_id)->first();
    

        if (!empty($active_loans)) {

            /** Get user phone number based on the user_id */

            $user = User::where('id', $active_loans->user_id)->first();
            $PhoneNumber = $user->ext_phone;
            /** Append 254 */
            //$PhoneNumber = SMS::clean_phone_number($user->telephone);
            // $PhoneNumber = "254708823158";
            $Amount = $active_loans->disbursed;
            $B2CEnvironment = env('MPESA_B2C_ENV');


            $token = MpesaAPI::generateB2CAccessToken();
            if ($B2CEnvironment == 'live') {

                if ($B2CEnvironment)

                    $url = 'https://api.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';
            } elseif ($B2CEnvironment == 'sandbox') {

                $url = 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';
            } else {
                return json_encode(['Message' => 'invalid application status']);
            }


            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $token));


            $InitiatorName = "kybeeApp";
            $SecurityCredential = MpesaAPI::generate_security_credential();
            $CommandID = "SalaryPayment";
            $Amount = $Amount;
            $PartyA = '3030689';
            $PartyB = $PhoneNumber;
            $Remarks = "Loan disbursement";
            $QueueTimeOutURL = "https://app.kybeeloans.com/api/transactions/queue_timeout_url";
            $ResultURL = "https://app.kybeeloans.com/api/transactions/result_url";
            $Occasion = "Loan Disbursement";


            /** MPESA B2C post data */
            $curl_post_data = array(
                'InitiatorName' => $InitiatorName,
                'SecurityCredential' => $SecurityCredential,
                'CommandID' => $CommandID,
                'Amount' => $Amount,
                'PartyA' => $PartyA,
                'PartyB' => $PartyB,
                'Remarks' => $Remarks,
                'QueueTimeOutURL' => $QueueTimeOutURL,
                'ResultURL' => $ResultURL,
                'Occasion' => $Occasion
            );

            $data_string = json_encode($curl_post_data);
            $data_string1 = json_decode($data_string, true);

           

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

            $curl_response = curl_exec($curl);
            $array = (array) $curl_response;
            $array1 = $array[0];

            $res1 = json_decode($array1, true);
            $res2 = json_decode(json_encode($res1), true);

        } else {
        }
    }
}
