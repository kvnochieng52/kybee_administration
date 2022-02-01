<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {

        $results = [];

        if (Auth::attempt(['telephone' => $request->input('telephone'), 'password' => $request->input('password')])) {
            $user_details = User::find(Auth::id());

            if ($user_details->is_active == 1) {
                $results['success'] = true;
                $results['data'] = $user_details;
                $results['message'] = 'success';
            } else {
                $results['success'] = false;
                $results['data'] = [];
                $results['message'] = 'Your account is not activated. Please contact us for assistance';
            }
        } else {
            $results['success'] = false;
            $results['data'] = [];
            $results['message'] = 'Credentials do not march. Please check and Try again';
        }

        return $results;
    }


    public function regsiter(Request $request)
    {
    }
}
