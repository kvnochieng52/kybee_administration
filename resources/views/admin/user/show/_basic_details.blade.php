<table class="table table-bordered table-striped display nowrap reduce_padding">
    <tbody>
        <tr>
            <th>Full Name</th>
            <th>ID Number</th>
            <th>Telephone</th>
        </tr>

        <tr>
            <td>{{$user_details->first_name}} {{$user_details->middle_name}} {{$user_details->last_name}}</td>
            <td>{{$user_details->id_number}}</td>
            <td>{{$user_details->telephone}}</th>
        </tr>

        <tr>
            <th>Email Address</th>
            <th>Date of Birth</th>
            <th>Marital Status</th>
        </tr>

        <tr>
            <td>{{$user_details->email}}</td>
            <td>{{\Carbon\Carbon::parse($user_details->date_of_birth)->format("d-m-Y")}}</td>
            <td>{{$user_details->first_name}}</th>
        </tr>

        <tr>
            <th>Gender</th>
            <th>Education Level</th>
            <th>Employment Status</th>
        </tr>

        <tr>
            <td>{{$user_details->gender_name}}</td>
            <td>{{$user_details->education_level_name}}</td>
            <td>{{$user_details->employment_status_name}}</th>
        </tr>


        <tr>
            <th>Salary Range</th>
            <th>County</th>
            <th>Home Address</th>
        </tr>

        <tr>
            <td>{{$user_details->salary_range}}</td>
            <td>{{$user_details->user_county_name}}</td>
            <td>{{$user_details->home_address}}</th>
        </tr>

        <tr>
            <th>Company County</th>
            <th>Company Address</th>
            <th>Current Loan Limit</th>
        </tr>

        <tr>
            <td>{{$user_details->company_county_name}}</td>
            <td>{{$user_details->company_address}}</td>
            <td>{{$user_details->max_amount}}</th>
        </tr>

    </tbody>

</table>

<h5>Referees</h5>

<table class="table table-bordered table-striped display nowrap reduce_padding">
    <thead>
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Relation</th>
            <th>Telephone</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($referees as $key=>$referee)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$referee->referee_name}}</td>
            <td>{{$referee->relationship_type_name}}</td>
            <td>{{$referee->telephone}}</th>
        </tr>

        @endforeach

    </tbody>
</table>