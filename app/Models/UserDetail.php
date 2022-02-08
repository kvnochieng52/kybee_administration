<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    public static function getUserByID($ID)
    {
        return UserDetail::leftJoin('users', 'user_details.user_id', 'users.id')
            ->leftJoin('user_loan_distributions', 'user_details.user_id', 'user_loan_distributions.user_id')
            ->leftJoin('loan_distributions', 'user_loan_distributions.loan_distribution_id', 'loan_distributions.id')
            ->where('user_details.user_id', $ID)
            ->first([
                'user_details.*',
                'user_loan_distributions.loan_distribution_id',
                'loan_distributions.min_amount',
                'loan_distributions.max_amount',
                'loan_distributions.period',
                'loan_distributions.order'
            ]);
    }
}
