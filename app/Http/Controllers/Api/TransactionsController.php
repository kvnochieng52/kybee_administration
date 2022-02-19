<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanDisbursement;
use App\Models\LoanRepayment;
use App\Models\LoanStatus;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\MpesaAPI;
use App\Models\RepaymentStatus;
use App\Models\SMS;
use App\Models\UserDetail;
use App\User;

class TransactionsController extends Controller
{
    /** Get Mpesa API Access token for C2B shortcode */
    public function get_access_token()
    {
        $access_token = MpesaAPI::generateC2BAccessToken();
        echo $access_token;
    }

    /** This is Customer 2 Business Payment Logic */
    public function confirmation_url()
    {

        header('Content-Type: application/json');

        $response = '{
            "ResultCode": 0,
            "ResultDesc": "Confirmation Received Successfully"
        }';

        // Response from M-PESA Stream
        $mpesaResponse = file_get_contents('php://input');

        $current_time = Carbon::now('Africa/Nairobi');
        $PayDate = $current_time->toDateString();
        $PayTime = $current_time->toTimeString();

        // log the daily response in a .json file
        $logFile = $PayDate . 'MPESAConfirmationResponse.json';

        $jsonMpesaResponse = json_decode($mpesaResponse, true);

        /** Log the transaction details in the daily log file */
        Log::info("-----------------START MPESA LOGGING PROCESS------------------------------");
        Log::info(print_r($mpesaResponse, true));
        Log::info(print_r($jsonMpesaResponse, true));
        Log::info("-----------------STOP MPESA LOGGING PROCESS------------------------------");

        /** Capture the Mpesa response parameters */
        $TransID = $jsonMpesaResponse['TransID'];
        $TransAmount = $jsonMpesaResponse['TransAmount'];
        $BillRefNumber = SMS::validate_phone_number($jsonMpesaResponse['BillRefNumber']);
        $OrgAccountBalance = $jsonMpesaResponse['OrgAccountBalance'];
        $MSISDN = $jsonMpesaResponse['MSISDN'];


        // write to file
        $log = fopen($logFile, 'a');
        fwrite($log, $mpesaResponse);
        fclose($log);

        echo $response;

        /** Check customer information based on the phone number 
         * If phone number exists, do the necessary logic
         */
        $loan_status = LoanStatus::SENT;
        $repay_status = RepaymentStatus::OPEN;

        $customer = User::where('telephone', $BillRefNumber)->first();

        if (!empty($customer)) {
            /** Add the logic here */
            $user_id = $customer->id;
            Log::info("User ID:" . $user_id);

            /** Get the active loan of the customer */
            $active_loan = Loan::where('user_id', $user_id)->where('loan_status_id', $loan_status)
                ->where('repayment_status_id', $repay_status)->first();
            Log::info("Active Loan:" . $active_loan);
            $balance = $active_loan->balance;
            $new_balance = $balance - $TransAmount;
            $amount_paid = $active_loan->amount_paid;
            $new_amount_paid = $amount_paid + $TransAmount;

            Log::info("Balance:" . $balance);
            Log::info("New Balance:" . $new_balance);
            Log::info("Paid:" . $amount_paid);
            Log::info("New Paid:" . $new_amount_paid);

            /** Update amount paid in loans table */

            if ($new_balance <= 0) {
                /** Update repay status id to 2 (Closed) */

                $new_repay_status_id = RepaymentStatus::CLOSED;
                $new_repay_status_array = array(
                    'repayment_status_id' => $new_repay_status_id
                );

                $update_repayment_status_id = Loan::where('id', $active_loan->id)->update($new_repay_status_array);
            }

            $new_loan_amounts = array(
                'amount_paid' => $new_amount_paid,
                'balance' => $new_balance
            );

            $update_loan_amounts = Loan::where('id', $active_loan->id)->update($new_loan_amounts);

            /** Save loan repayment transaction details */
            $loan_repayment = new LoanRepayment();
            $loan_repayment->loan_id = $active_loan->id;
            $loan_repayment->paid_amount = $TransAmount;
            $loan_repayment->mpesa_code = $TransID;
            $loan_repayment->account_number = $BillRefNumber;
            $loan_repayment->msisdn = $MSISDN;
            $loan_repayment->org_balance = $OrgAccountBalance;
            $loan_repayment->date_paid =  Carbon::now('Africa/Nairobi');
            $loan_repayment->user_id = $user_id;
            $loan_repayment->created_by = 1;
            $loan_repayment->updated_by = 1;

            $loan_repayment->save();
        }
    }

    public function validation_url()
    {


        header('Content-Type: application/json');

        $response = '{
        "ResultCode": 0,
        "ResultDesc": "Confirmation Received Successfully"
    }';

        // Response from M-PESA Stream
        $mpesaResponse = file_get_contents('php://input');

        $current_time = Carbon::now('Africa/Nairobi');
        $PayDate = $current_time->toDateString();
        $PayTime = $current_time->toTimeString();

        // log the daily response in a .json file
        $logFile = $PayDate . 'MPESAValidationResponse.json';

        $jsonMpesaResponse = json_decode($mpesaResponse, true);

        /** Log the transaction details in the daily log file */
        Log::info("-----------------START MPESA LOGGING PROCESS------------------------------");
        Log::info(print_r($mpesaResponse, true));
        Log::info(print_r($jsonMpesaResponse, true));
        Log::info("-----------------STOP MPESA LOGGING PROCESS------------------------------");

        /** Capture the Mpesa response parameters */
        $TransID = $jsonMpesaResponse['TransID'];
        $TransAmount = $jsonMpesaResponse['TransAmount'];
        $BusinessShortCode = $jsonMpesaResponse['BusinessShortCode'];
        $BillRefNumber = ucwords($jsonMpesaResponse['BillRefNumber']);
        $InvoiceNumber = $jsonMpesaResponse['InvoiceNumber'];
        $OrgAccountBalance = $jsonMpesaResponse['OrgAccountBalance'];
        $MSISDN = $jsonMpesaResponse['MSISDN'];


        // write to file
        $log = fopen($logFile, 'a');
        fwrite($log, $mpesaResponse);
        fclose($log);

        echo $response;
    }

    public function queue_timeout_url()
    {
       

        header("Content-Type:application/json");

        // Receive Json string from Safaricom

        $request = file_get_contents('php://input');

        //Put the json string that we received from Safaricom to an array


        //$array = json_decode($request, true);

        file_put_contents("B2CFailMpesa.json", $request);
    }

    public function result_url()
    {

        // try {
           


        header("Content-Type:application/json");

        $B2CResponse = file_get_contents('php://input');

        $decResponse = json_decode($B2CResponse, true);
       // dd($decResponse);

        //$ResultCode = $B2CResponse['Result']);
        //file_put_contents("B2CResultResponseTest.txt", $ResultCode);

        $result = json_encode($decResponse['Result']['ResultParameters']['ResultParameter']);

        $dec1Response = json_decode($result, true);

        $ResultCode  = json_encode($decResponse['Result']['ResultCode']);
        $TransactionReceipt = str_replace('"', '', json_encode($dec1Response[1]['Value']));
        $TransactionAmount = str_replace('"', '', json_encode($dec1Response[0]['Value']));
        $B2CWorkingAccountAvailableFunds = str_replace('"', '', json_encode($dec1Response[5]['Value']));
        $B2CUtilityAccountAvailableFunds = str_replace('"', '', json_encode($dec1Response[4]['Value']));
        $TransactionCompletedDateTime = str_replace('"', '', json_encode($dec1Response[3]['Value']));
        $ReceiverPartyPublicName = str_replace('"', '', json_encode($dec1Response[2]['Value']));
        $ReceiverPartyPublicName = explode(' - ', trim($ReceiverPartyPublicName));
        $ReceiverPartyPhone = $ReceiverPartyPublicName[0];
        $ReceiverPartyName = !empty($ReceiverPartyPublicName[1]) ? $ReceiverPartyPublicName[1] : "No Name";
        $B2CChargesPaidAccountAvailableFunds = str_replace('"', '', json_encode($dec1Response[7]['Value']));
        $B2CRecipientIsRegisteredCustomer = str_replace('"', '', json_encode($dec1Response[6]['Value']));

        Log::info("ResultDesc" . json_encode($decResponse['Result']['ResultDesc']));
        Log::info("TransactionReceipt" . $TransactionReceipt);
        Log::info("Phone" . $ReceiverPartyPhone);
        Log::info("TransactionAmount" . $TransactionAmount);
        Log::info("ReceiverPartyName" . $ReceiverPartyName);
        Log::info("TransactionCompletedDateTime" . $TransactionCompletedDateTime);
        Log::info("B2CUtilityAccountAvailableFunds" . $B2CUtilityAccountAvailableFunds);
        Log::info("B2CWorkingAccountAvailableFunds" . $B2CWorkingAccountAvailableFunds);

        if ($ResultCode  == 0) {

            /** Get active loan that has been sent to the customer */
            $user_phone = SMS::strip_ext_code_phone_number($ReceiverPartyPhone);
            $customer = User::where('telephone', $user_phone)->first();

            $user_id = $customer->id;
            $loan_status = LoanStatus::APPROVED;

            /** Get the  */
            $active_loan = Loan::where('user_id', $user_id)->where('loan_status_id', $loan_status)->first();

            /** Update the loan status id to 4 - Sent */
            $new_loan_status_id = 4;
            $new_loan_status_array = array(
                'loan_status_id' => $new_loan_status_id
            );

            $update_loan_status = Loan::where('id', $active_loan->id)->update($new_loan_status_array);

            $current_time = Carbon::now('Africa/Nairobi');
            /** Save the loan disbursement transaction details */
            $loan_disbursement = new LoanDisbursement();
            $loan_disbursement->loan_id = $active_loan->id;
            $loan_disbursement->mpesa_code = $TransactionReceipt;
            $loan_disbursement->amount_sent = $TransactionAmount;
            $loan_disbursement->receiver_phone = $ReceiverPartyPhone;
            $loan_disbursement->b2c_utility_bal = $B2CUtilityAccountAvailableFunds;
            $loan_disbursement->b2c_working_bal = $B2CWorkingAccountAvailableFunds;
            $loan_disbursement->date_sent = $current_time;

            $loan_disbursement->save();
            /** Start loan sent logg */
           
            Log::info("-----------Start Loan Disbursement Log-------");
            Log::info("Loan ID: " .$active_loan->id. " Loan Amount: ". $TransactionAmount. " Phone Number: ". $ReceiverPartyPhone. " Date: ". $current_time);
            Log::info("-----------Stop Loan Disbursement Log-------");

          
        }else{
            /** No transaction has gone successful */
            
        }



        /** Captiure Mpesa response and save the data here */

        // $TransactionReceipt = str_replace('"', '', json_encode($dec1Response[0]['Value']));
        // $TransactionAmount = str_replace('"', '', json_encode($dec1Response[1]['Value']));
        // $B2CWorkingAccountAvailableFunds = str_replace('"', '', json_encode($dec1Response[2]['Value']));
        // $B2CUtilityAccountAvailableFunds = str_replace('"', '', json_encode($dec1Response[3]['Value']));
        // $TransactionCompletedDateTime = str_replace('"', '', json_encode($dec1Response[4]['Value']));
        // $ReceiverPartyPublicName = str_replace('"', '', json_encode($dec1Response[5]['Value']));
        // $ReceiverPartyPublicName = explode(' - ', trim($ReceiverPartyPublicName));
        // $ReceiverPartyPhone = $ReceiverPartyPublicName[0];
        // $ReceiverPartyName = !empty($ReceiverPartyPublicName[1]) ? $ReceiverPartyPublicName[1] : "No Name";
        // $B2CChargesPaidAccountAvailableFunds = str_replace('"', '', json_encode($dec1Response[6]['Value']));
        // $B2CRecipientIsRegisteredCustomer = str_replace('"', '', json_encode($dec1Response[7]['Value']));

        // $pay_exists = Payment::where('TransactionReceipt', $TransactionReceipt)->first();

        //   if (empty($pay_exists)) {
        // $payment = new Payment();
        // $payment->TransactionReceipt = $TransactionReceipt;
        // $payment->TransactionAmount = $TransactionAmount;
        // $payment->B2CWorkingAccountAvailableFunds = $B2CWorkingAccountAvailableFunds;
        // $payment->B2CUtilityAccountAvailableFunds = $B2CUtilityAccountAvailableFunds;
        // $payment->TransactionCompletedDateTime = $TransactionCompletedDateTime;
        // $payment->ReceiverPartyPhone = $ReceiverPartyPhone;
        // $payment->ReceiverPartyName = $ReceiverPartyName;
        // $payment->B2CChargesPaidAccountAvailableFunds = $B2CChargesPaidAccountAvailableFunds;
        // $payment->B2CRecipientIsRegisteredCustomer = $B2CRecipientIsRegisteredCustomer;

        // $payment->save();


        //file_put_contents("B2CResultResponse.txt", $dec1Response);
        // file_put_contents("B2CResultResponse.json", $dec1Response);
        // }


       // file_put_contents("B2CResultResponse.json", $decResponse);
        // } catch (\Throwable $e) {

        //     DB::rollBack();
        //     \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
        // }


        //$array = json_decode($request, true);
    }

    /** MPESA B2C (Business disbursement of loan to customer) */
    public function send_loan(Request $request)
    {
        /** Get approved loan appliactions that have not beemn disbursed yet
         * This could be fetched through a background job
         */
        $loan_status_id = LoanStatus::APPROVED;
        $active_loans = Loan::where('loan_status_id', $loan_status_id)->first();

        if (!empty($active_loans)) {

            /** Get user phone number based on the user_id */

            $user = User::where('id', $active_loans->user_id)->first();
            $PhoneNumber = $user->ext_phone;
            /** Append 254 */
            //$PhoneNumber = SMS::clean_phone_number($user->ext_phone);
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


            /** Transfer this code to the result url */
            //try {

                //$resCode = $res2['ResponseCode'];

                /** Update the loan status id to 4 - Sent */
                // $new_loan_status_id = 2;
                // $new_loan_status_array = array(
                //     'loan_status_id' => $new_loan_status_id
                // );

                // $update_loan_status = Loan::where('id', $active_loans->id)->update($new_loan_status_array);

                // /** Log the successful transaction */
                // $current_date_and_time = Carbon::now('Africa/Nairobi');
                // Log::info("-----------------Start New Transaction Entry (Loan Disbursement)-----------------");
                // Log::info("Phone Number: " . $PhoneNumber . "Amount: " . $Amount . "Date and Time: " . $current_date_and_time);
            //     // Log::info("-----------------Stop New Transaction Entry (Loan Disbursement)-----------------");
            // } catch (\Throwable $e) {
            //     $msg = $res2['errorMessage'];

            //     \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            // }
        } else {
        }
    }
}
