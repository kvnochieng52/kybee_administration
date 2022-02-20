@extends('adminlte::page')
@section('title', 'Transactions::Loan Repayments')


@section('content')

@include('notices')

<div class="card card-default color-palette-box">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-cash"></i>
            Transactions: Loan Disbursements
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
                                <th>Mpesa Code</th>
                                <th>Amount Sent</th>
                                <th>Receiver Phone</th>
                                <th>Utility Balance</th>
                                <th>Working Balance</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $key=>$transaction)
                            <tr>

                                <td>{{$key+1}}</td>

                                <td>{{$transaction->mpesa_code}}</td>
                                <td>{{$transaction->amount_sent}}</td>
                                <td>{{$transaction->receiver_phone}}</td>
                                <td>{{$transaction->b2c_utility_bal}}</td>
                                <td>{{$transaction->b2c_working_bal}}</td>
                                <td>{{$transaction->date_sent}}</td>
                                <td>
                                    <span class="badge badge-success">SENT</span>
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