<div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped  records reduce_padding">
        <thead>
            <tr>
                <th>#</th>
                <th>Loan Telephone</th>
                <th>Loan Amount</th>
                <th>Balance</th>
                <th>Disbursed</th>
                <th>Intrest</th>
                <th>Application Date</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Repayment Status</th>

            </tr>
        </thead>
        <tbody>
            @foreach($loans as $key=>$loan)
            <tr>

                <td>{{$key+1}}</td>
                <td>{{$loan->telephone}}</td>
                <td>Ksh {{$loan->total_amount}}</td>
                <td>Ksh {{$loan->balance}}</td>
                <td>Ksh {{$loan->disbursed}}</td>
                <td>Ksh {{$loan->interest+$loan->commission}}</td>
                <td> {{\Carbon\Carbon::parse($loan->application_date)->format("d-F-Y")}}</td>
                <td> {{\Carbon\Carbon::parse($loan->due_date)->format("d-F-Y")}}</td>
                <td>


                    <span
                        class="badge badge-{{$loan->loan_status_id==2? 'success' : 'primary' }}">{{$loan->loan_status_name}}
                    </span>


                </td>

                <td>
                    <span
                        class="badge badge-{{$loan->repayment_status_id==2? 'success' : 'secondary' }}">{{$loan->repayment_status_name}}
                    </span>


                </td>

            </tr>

            @endforeach

        </tbody>
    </table>
</div>