@extends('adminlte::page')
@section('title', 'Settings::Terms and Conditions')


@section('content')

@include('notices')

<div class="card card-default color-palette-box">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-cash"></i>
            Loans
        </h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped records">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Telephone</th>
                                <th>Loan Amount</th>
                                <th>Disbursed</th>
                                <th>Balance</th>
                                <th>Paid Amount</th>
                                <th>Intrest</th>
                                <th>Application Date</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loans as $key=>$loan)
                            <tr>

                                <td>{{$key+1}}</td>
                                <td>
                                    <a href="/loans/{{$loan->id}}/edit" title="Show Details">
                                        <b>{{$loan->first_name}} {{$loan->middle_name}} {{$loan->last_name}}</b>
                                    </a>
                                </td>
                                <td>{{$loan->telephone}}</td>
                                <td>Ksh {{$loan->total_amount}}</td>
                                <td>Ksh {{$loan->disbursed}}</td>
                                <td>Ksh {{$loan->balance}}</td>
                                <td>Ksh {{$loan->amount_paid}}</td>
                                <td>Ksh {{$loan->interest+$loan->commission}}</td>
                                <td> {{\Carbon\Carbon::parse($loan->application_date)->format("d-F-Y")}}</td>
                                <td> {{\Carbon\Carbon::parse($loan->due_date)->format("d-F-Y")}}</td>
                                <td>

                                    <a href="/loans/{{$loan->id}}/edit" title="Show Details">
                                        <span
                                            class="badge badge-{{$loan->loan_status_id==2? 'success' : 'primary' }}">{{$loan->loan_status_name}}
                                        </span>

                                    </a>
                                </td>
                                <td>

                                    <a href="/loans/{{$loan->id}}/edit" title="Show Details"
                                        class="btn btn-xs btn-secondary"><strong> <i class="fas fa-edit"></i></strong>
                                    </a>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        {{-- <div class="card-footer">
            {{ $loans->links() }}

        </div> --}}
    </div>
</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    $(function () {
        $(".records").DataTable({
        "responsive": false,
        "autoWidth": false,
        "ordering": false,
        });
    })

</script>
@stop