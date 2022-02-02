<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\MpesaAPI;

class TransactionsController extends Controller
{
    /** Get Mpesa API Access token for C2B shortcode */
    public function get_access_token()
    {
        $access_token = MpesaAPI::generateC2BAccessToken();
        echo $access_token;
    }

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
            $logFile = $PayDate.'MPESAConfirmationResponse.json';

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

            /** Check customer information based on the phone number 
             * If phone number exists, do the necessary logic
            */

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
        $logFile = $PayDate.'MPESAValidationResponse.json';

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
}
