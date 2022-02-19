{!!
Form::open(['action'=>['Admin\\UserController@update',$user->id],'method'=>'POST','class'=>'form
user_form','enctype'=>'multipart/form-data'])
!!}
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Basic Details</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

        <div class="col-md-12">

            <div class="row">
                <div class="col-md-4">
                    {{Form::label('first_name', 'First Name*')}}
                    <div class="form-group">
                        {{Form::text('first_name', $user_details->first_name,['class'=>'form-control',
                        'placeholder'=>'Enter First Name'])}}
                    </div>
                </div>


                <div class="col-md-4">
                    {{Form::label('middle_name', 'Middle Name* ')}}
                    <div class="form-group">
                        {{Form::text('middle_name', $user_details->middle_name,['class'=>'form-control',
                        'placeholder'=>'Enter Middle Name'])}}
                    </div>
                </div>

                <div class="col-md-4">
                    {{Form::label('last_name', 'Last Name* ')}}
                    <div class="form-group">
                        {{Form::text('last_name', $user_details->last_name,['class'=>'form-control',
                        'placeholder'=>'Enter Last Name'])}}
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-4">
                    {{Form::label('id_number', 'ID Number*')}}
                    <div class="form-group">
                        {{Form::text('id_number', $user_details->id_number,['class'=>'form-control',
                        'placeholder'=>'ID Number'])}}
                    </div>
                </div>


                {{-- <div class="col-md-4">
                    {{Form::label('telephone', 'Telephone* ')}}
                    <div class="form-group">
                        {{Form::text('telephone', $user_details->telephone,['class'=>'form-control',
                        'placeholder'=>'Enter Telephone'])}}
                    </div>
                </div> --}}

                <div class="col-md-4">
                    {{Form::label('email', 'Email Address* ')}}
                    <div class="form-group">
                        {{Form::text('email', $user_details->email,['class'=>'form-control',
                        'placeholder'=>'Enter Email Address'])}}
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col-md-4">
                    {{Form::label('date_of_birth', 'Date of Birth*')}}
                    <div class="form-group">
                        {{Form::text('date_of_birth',\Carbon\Carbon::parse($user_details->date_of_birth)->format("d-m-Y"),['class'=>'form-control
                        date_select',
                        'placeholder'=>'Enter date of Birth'])}}
                    </div>
                </div>


                <div class="col-md-4">

                    {{Form::label('marital_status', 'Marital Status')}}

                    <div class="form-group">
                        {{ Form::select('marital_status', $marital_statuses,$user_details->marital_status_id, ['class'
                        =>
                        'form-control','placeholder'=>'--None--','required'=>'required']) }}
                    </div>
                </div>

                <div class="col-md-4">
                    {{Form::label('gender', 'Gender')}}

                    <div class="form-group">
                        {{ Form::select('gender', $genders,$user_details->gender_id, ['class' =>
                        'form-control','placeholder'=>'--None--','required'=>'required']) }}
                    </div>
                </div>

            </div>



            <div class="row">
                <div class="col-md-4">
                    {{Form::label('education_level', 'Education Level')}}

                    <div class="form-group">
                        {{ Form::select('education_level', $education_levels,$user_details->education_level_id, ['class'
                        =>
                        'form-control','placeholder'=>'--None--','required'=>'required']) }}
                    </div>
                </div>


                <div class="col-md-4">

                    {{Form::label('employment_status', 'Employment Status')}}

                    <div class="form-group">
                        {{ Form::select('employment_status', $employment_statuses,$user_details->employment_status_id,
                        ['class' =>
                        'form-control','placeholder'=>'--None--','required'=>'required']) }}
                    </div>
                </div>

                <div class="col-md-4">
                    {{Form::label('salary_range', 'Salary Range')}}

                    <div class="form-group">
                        {{ Form::select('salary_range', $salary_ranges,$user_details->salary_range_id, ['class' =>
                        'form-control','placeholder'=>'--None--','required'=>'required']) }}
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col-md-4">
                    {{Form::label('county', 'County')}}

                    <div class="form-group">
                        {{ Form::select('county', $counties,$user_details->county_id, ['class' =>
                        'form-control','placeholder'=>'--None--','required'=>'required']) }}
                    </div>
                </div>


                <div class="col-md-4">

                    {{Form::label('home_address', 'Home Address*')}}
                    <div class="form-group">
                        {{Form::text('home_address', $user_details->home_address,['class'=>'form-control',
                        'placeholder'=>'User
                        Full Names'])}}
                    </div>
                </div>

                <div class="col-md-4">
                    {{Form::label('company_county', 'Company County')}}

                    <div class="form-group">
                        {{ Form::select('company_county', $counties,$user_details->company_county_id, ['class' =>
                        'form-control','placeholder'=>'--None--','required'=>'required']) }}
                    </div>
                </div>

            </div>



            <div class="row">
                <div class="col-md-4">
                    {{Form::label('company_address', 'Company address* ')}}
                    <div class="form-group">
                        {{Form::text('company_address', $user_details->company_address,['class'=>'form-control',
                        'placeholder'=>'Enter company Address'])}}
                    </div>
                </div>
            </div>





            <button type="submit" class="btn btn-primary btn-flat">UPDATE DETAILS</button>




        </div>
    </div>

</div>

<input type="hidden" name="section" value="basic_details">
{{Form::hidden('_method','PUT')}} {!! Form::close() !!}
{!! Form::close() !!}