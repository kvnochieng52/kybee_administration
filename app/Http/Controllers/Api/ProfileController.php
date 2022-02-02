<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function update(Request $request)
    {

        $user_details = UserDetail::where('user_id', $request->input('user_id'))->first();

        $user_details_array = [
            'first_name' => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'id_number' => $request->input('id_number'),
            'email' => $request->input('email'),
            'date_of_birth' => Carbon::parse($request->input('dob'))->format("Y-m-d"),
        ];

        if (empty($user_details)) {
            $user_details_array['user_id'] = $request->input('user_id');
            $user_details_array['created_by'] = $request->input('user_id');
            $user_details_array['updated_by'] = $request->input('user_id');
            $user_details_array['created_at'] = Carbon::now()->toDateTimeString();
            $user_details_array['updated_at'] = Carbon::now()->toDateTimeString();

            UserDetail::insert($user_details_array);
        } else {
            $user_details_array['updated_by'] = $request->input('user_id');
            $user_details_array['updated_at'] = Carbon::now()->toDateTimeString();

            UserDetail::where('user_id', $request->input('user_id'))->update($user_details_array);
        }

        return [
            'success' => true,
            'message' => 'Details updated successfully'
        ];
    }


    public function details(Request $request)
    {
        $user_details = UserDetail::where('user_id', $request->input('user_id'))->first();
        if (!empty($user_details)) {
            return [
                'success' => true,
                'message' => 'Details found',
                'data' => $user_details,
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Details not found',
                'data' => [],
            ];
        }
    }
}
