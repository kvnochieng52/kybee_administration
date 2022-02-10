<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use AfricasTalking\SDK\AfricasTalking;

class SMS extends Model
{



    public static function send($phone, $message)
    {
        $username = env('AFRICATALKING_USERNAME'); // use 'sandbox' for development in the test environment
        $apiKey   = env('AFRICATALKING_API_KEY'); // use your sandbox app API key for development in the test environment
        $AT       = new AfricasTalking($username, $apiKey);

        // Get one of the services
        $sms      = $AT->sms();

        // Use the service
        $result   = $sms->send([
            'to'      => self::clean_phone_number($phone),
            'message' => $message,
        ]);

        return $result;
    }

    public static function clean_phone_number($phonenumber)
    {
        $DestinationPhoneNum = $phonenumber;
        $DestinationPhoneNum = substr($DestinationPhoneNum, -9, 9);
        return $DestinationPhoneNum = '254' . $DestinationPhoneNum;
    }

    public static function validate_phone_number($phonenumber){

        $validated_phonenumber = str_replace('-', '', preg_replace('/[^a-zA-Z0-9-_\.]/','', $phonenumber)); 
        return $validated_phonenumber;
    }
}
