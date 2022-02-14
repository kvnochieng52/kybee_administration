<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    public static function getUserByID($ID)
    {
        return User::leftJoin('user_details', 'users.id', 'user_details.user_id')
            ->leftJoin('user_loan_distributions', 'user_details.user_id', 'user_loan_distributions.user_id')
            ->leftJoin('loan_distributions', 'user_loan_distributions.loan_distribution_id', 'loan_distributions.id')
            ->where('users.id', $ID)
            ->first([
                'user_details.*',
                'user_loan_distributions.loan_distribution_id',
                'loan_distributions.min_amount',
                'loan_distributions.max_amount',
                'loan_distributions.period',
                'loan_distributions.order',
                'users.telephone'
            ]);
    }


    public static function checkUserProfile($id)
    {
        $result = true;;
        $details = self::getUserByID($id);
        if (!empty($details)) {
            if (
                empty($details->first_name) ||
                empty($details->middle_name) ||
                empty($details->email) ||
                empty($details->id_number) ||
                empty($details->date_of_birth) ||
                empty($details->marital_status_id) ||
                empty($details->gender_id) ||
                empty($details->education_level_id) ||
                empty($details->employment_status_id) ||
                empty($details->salary_range) ||
                empty($details->company_county_id) ||
                empty($details->company_address) ||
                empty($details->county_id) ||
                empty($details->home_address)
            ) {
                $result = false;
            } else {
                $result = true;
            }
        } else {
            $result = false;
        }


        return $result;
    }
}
