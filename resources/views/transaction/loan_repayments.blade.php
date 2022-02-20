@extends('adminlte::page')
@section('title', 'Transactions::Loan Repayments')


@section('content')

@include('notices')

<div class="card card-default color-palette-box">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-cash"></i>
            Transactions: Loan Repayments
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
                                <th>Account No</th>
                                <th>Msisdn</th>
                                <th>Paid Amount</th>
                                <th>Org Balance</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $key=>$transaction)
                            <tr>

                                <td>{{$key+1}}</td>

                                <td>{{$transaction->mpesa_code}}</td>
                                <td>{{$transaction->account_number}}</td>
                                <td>{{$transaction->msisdn}}</td>
                                <td>{{$transaction->paid_amount}}</td>
                                <td>{{$transaction->org_balance}}</td>
                                <td>{{$transaction->date_paid}}</td>
                                <td>
                                    <span class="badge badge-success">PAID</span>
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