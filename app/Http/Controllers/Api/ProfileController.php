<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\County;
use App\Models\EducationLevel;
use App\Models\EmploymentStatus;
use App\Models\Gender;
use App\Models\MaritalStatus;
use App\Models\Referee;
use App\Models\RelationType;
use App\Models\SalaryRange;
use App\Models\Setting;
use App\Models\UserDetail;
use App\Models\UserFile;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function update(Request $request)
    {

        $user_details = UserDetail::getUserByID($request->input('user_id'));


        if (empty($user_details)) {

            UserDetail::insert([
                'first_name' => $request->input('first_name'),
                'middle_name' => $request->input('middle_name'),
                'last_name' => $request->input('last_name'),
                'id_number' => $request->input('id_number'),
                'email' => $request->input('email'),
                'date_of_birth' => Carbon::parse($request->input('dob'))->format("Y-m-d"),
                'gender_id' => $request->input('gender'),
                'user_id' => $request->input('user_id'),
                'created_by' => $request->input('user_id'),
                'updated_by' => $request->input('user_id'),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        } else {


            switch ($request->input('section')) {
                case "basic":

                    UserDetail::where('user_id', $request->input('user_id'))->update([
                        'first_name' => $request->input('first_name'),
                        'middle_name' => $request->input('middle_name'),
                        'last_name' => $request->input('last_name'),
                        'id_number' => $request->input('id_number'),
                        'email' => $request->input('email'),
                        'date_of_birth' => Carbon::parse($request->input('dob'))->format("Y-m-d"),
                        'gender_id' => $request->input('gender'),
                        'updated_by' => $request->input('user_id'),
                        'updated_at' => Carbon::now()->toDateTimeString(),
                    ]);
                    break;
                case "contacts":

                    Referee::where('user_id', $request->input('user_id'))->delete();
                    Referee::insert([
                        [
                            'user_id' => $request->input('user_id'),
                            'referee_name' => $request->input('ref_one_name'),
                            'telephone' => $request->input('ref_one_mobile_no'),
                            'relationship_type_id' => $request->input('ref_one_relation'),
                            'created_by' => $request->input('user_id'),
                            'updated_by' => $request->input('user_id'),
                            'created_at' => Carbon::now()->toDateTimeString(),
                            'updated_at' => Carbon::now()->toDateTimeString(),
                        ],
                        [
                            'user_id' => $request->input('user_id'),
                            'referee_name' => $request->input('ref_two_name'),
                            'telephone' => $request->input('ref_two_mobile_no'),
                            'relationship_type_id' => $request->input('ref_two_relation'),
                            'created_by' => $request->input('user_id'),
                            'updated_by' => $request->input('user_id'),
                            'created_at' => Carbon::now()->toDateTimeString(),
                            'updated_at' => Carbon::now()->toDateTimeString(),
                        ]
                    ]);
                    break;

                case "other_details":
                    UserDetail::where('user_id', $request->input('user_id'))->update([
                        'marital_status_id' => $request->input('marital_status'),
                        'education_level_id' => $request->input('education_level'),
                        'employment_status_id' => $request->input('employment_status'),
                        'salary_range' => $request->input('salary_range'),
                        'company_county_id' => $request->input('company_county'),
                        'company_address' => $request->input('company_address'),
                        'county_id' => $request->input('user_county'),
                        'home_address' => $request->input('user_address'),
                        'updated_by' => $request->input('user_id'),
                        'updated_at' => Carbon::now()->toDateTimeString(),
                    ]);

                    break;
            }
        }

        return [
            "success" => true,
            "message" => 'Details updated successfully'
        ];
    }


    public function details(Request $request)
    {

        $user_details = UserDetail::where('user_id', $request->input('user_id'))->first();
        $referees = Referee::where('user_id', $request->input('user_id'))->get();



        return [
            "success" => !empty($user_details) ? true : false,
            "message" => !empty($user_details) ? 'Details found' : 'Details not found',
            "relation_types" => RelationType::where('visible', 1)->get(['relationship_type_name', 'id']),
            "user_referees" => !empty($referees) ? $referees : [],
            "genders" =>  Gender::where('visible', 1)->get(['gender_name', 'id']),
            "counties" => County::where('visible', 1)->get(['county_name', 'id']),
            "marital_statuses" => MaritalStatus::where('visible', 1)->get(['marital_status_name', 'id']),
            "education_levels" => EducationLevel::where('visible', 1)->get(['education_level_name', 'id']),
            "employment_statuses" => EmploymentStatus::where('visible', 1)->get(['employment_status_name', 'id']),
            "salary_ranges" => SalaryRange::get(['salary_range', 'id']),
            "data" => !empty($user_details) ? $user_details : [],
            "sms_messages_sender" =>  explode(",", Setting::where('code', 'SMS_MESSAGES_SENDER')->first()->setting_value)
        ];
    }

    public function store_sms(Request $request)
    {

        if (count($request->input('sms')) > 0) {
            $file = UserFile::where('user_id', $request->input('user_id'))->first();
            if (!empty($file)) {
                $file->phone_messages = json_encode($request->input('sms'));
                $file->save();
            } else {

                UserFile::insert([
                    'user_id' => $request->input('user_id'),
                    'phone_messages' => json_encode($request->input('sms')),
                ]);
            }
        }
    }
}
