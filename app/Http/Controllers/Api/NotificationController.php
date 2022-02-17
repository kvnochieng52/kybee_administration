<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function get(Request $request)
    {
        return [
            'success' => true,
            'notifications' => Notification::getNotifications($request->input('user_id'))
        ];
    }
}
