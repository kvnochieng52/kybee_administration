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
            ->leftJoin('marital_statuses', 'user_details.marital_status_id', 'marital_statuses.id')
            ->leftJoin('genders', 'user_details.gender_id', 'genders.id')
            ->leftJoin('education_levels', 'user_details.education_level_id', 'education_levels.id')
            ->leftJoin('employment_statuses', 'user_details.employment_status_id', 'employment_statuses.id')
            ->leftJoin('salary_ranges', 'user_details.salary_range', 'salary_ranges.id')
            ->leftJoin('counties AS user_county', 'user_details.county_id', 'user_county.id')
            ->leftJoin('counties AS company_county', 'user_details.company_county_id', 'company_county.id')
            ->where('users.id', $ID)
            ->first([
                'user_details.*',
                'user_loan_distributions.loan_distribution_id',
                'loan_distributions.min_amount',
                'loan_distributions.max_amount',
                'loan_distributions.period',
                'loan_distributions.order',
                'users.telephone',
                'marital_statuses.marital_status_name',
                'genders.gender_name',
                'education_levels.education_level_name',
                'employment_statuses.employment_status_name',
                'salary_ranges.salary_range',
                'user_details.salary_range as salary_range_id',
                'user_county.county_name AS user_county_name',
                'company_county.county_name AS company_county_name',
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
                empty($details->home_address) ||
                empty($details->id_front) ||
                empty($details->id_back) ||
                empty($details->selfie)
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
