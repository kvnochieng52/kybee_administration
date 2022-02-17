<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notification extends Model
{
    public static function getNotifications($user_id)
    {
        return self::where('user_id', $user_id)
            ->orderBy('created_at', 'DESC')
            ->get([
                'notifications.*',
                DB::raw("DATE_FORMAT(created_at, '%d-%M-%Y') AS created_formatted")
            ]);
    }
}
