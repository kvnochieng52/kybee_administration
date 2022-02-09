<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\MpesaAPI;
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
        $BillRefNumber = ucwords($jsonMpesaResponse['BillRefNumber']);
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

        $customer = User::where('telephone', $BillRefNumber)->first();
        if (!empty($customer)) {
            /** Add the logic here */
            $customer_id = $customer->id;

            /** Get the active loan of the customer */

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

        //$ResultCode = $B2CResponse['Result']);
        //file_put_contents("B2CResultResponseTest.txt", $ResultCode);

        $result = json_encode($decResponse['Result']['ResultParameters']['ResultParameter']);

        $dec1Response = json_decode($result, true);

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

        $pay_exists = Payment::where('TransactionReceipt', $TransactionReceipt)->first();

        if (empty($pay_exists)) {
            $payment = new Payment();
            $payment->TransactionReceipt = $TransactionReceipt;
            $payment->TransactionAmount = $TransactionAmount;
            $payment->B2CWorkingAccountAvailableFunds = $B2CWorkingAccountAvailableFunds;
            $payment->B2CUtilityAccountAvailableFunds = $B2CUtilityAccountAvailableFunds;
            $payment->TransactionCompletedDateTime = $TransactionCompletedDateTime;
            $payment->ReceiverPartyPhone = $ReceiverPartyPhone;
            $payment->ReceiverPartyName = $ReceiverPartyName;
            $payment->B2CChargesPaidAccountAvailableFunds = $B2CChargesPaidAccountAvailableFunds;
            $payment->B2CRecipientIsRegisteredCustomer = $B2CRecipientIsRegisteredCustomer;

            $payment->save();


            file_put_contents("B2CResultResponse.txt", $payment);
            file_put_contents("B2CResultResponse.json", $payment);
        }


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
        $PhoneNumber = $request->phone_number;
        $Amount = $request->amount;
        $environment = env('MPESA_B2C_ENV');


        $token = MpesaAPI::generateB2CAccessToken();
        if ($environment == 'live') {

            if ($environment)

                $url = 'https://api.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';
        } elseif ($environment == 'sandbox') {

            $url = 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';
        } else {
            return json_encode(['Message' => 'invalid application status']);
        }


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $token));


        $InitiatorName = "PaskyAPI";
        $SecurityCredential = "JL3VafLKSy7DCQ0u3XWVWj4jfm3HSqBv62v25uLOphG/L6JCHVfcslqYSh1+oGVSocEwQX3aTQTq1dr54QHll5SAGFmGnajVyjwwDRNpFf8yxBl6gxZpPPu7Nbqgn8Mbgr85qxVHSjO6bKfAWfJnpMvHDjJ+aEYxUkXRunY1xgc9KzLmj+iGjvhiysKI71KSPHilA9hb5YJhHlYaglaVtfJayYkShO/qNitoXdUNrlJsHUiLZ6L0ubuuQvhKQ/KqkjMeozyttRM2H+wu0C+ZDGzHAAQrJIdNe1eLr6XVNUJ6mKu5I+kT/Qit52smeFQ3mziMKVwj2mRY0o1PjW18aw==";
        $CommandID = "SalaryPayment";
        $Amount = $Amount;
        $PartyA = '603021';
        $PartyA = '7502040';
        $PartyB = $PhoneNumber;
        $Remarks = "Loan disbursement";
        $QueueTimeOutURL = "https://pasky.driftsoftware.com/api/transactions/queue_timeout_url";
        $ResultURL = "https://pasky.driftsoftware.com/api/transactions/result_url";
        $Occasion = "Loan payment";


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
        


        try {

            $resCode = $res2['ResponseCode'];

         
        } catch (\Throwable $e) {
            $msg = $res2['errorMessage'];

            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
           
        }
    }
}
