@extends('adminlte::page')
@section('title', 'Dashboard')

{{-- @section('content_header')
<h1>Dashboard</h1>
@stop --}}

@section('content')
<div class="row">

    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon elevation-1" style="color:#6e4b4b"><i class="fas fa-money-bill"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Loans Pending Approval</span>
                <span class="info-box-number">
                    {{$loan_pending_approval_stats}}
                </span>
            </div>

        </div>
    </div>
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon elevation-1" style="color:#6e4b4b"><i class="fas fa-coins"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Loans Overdue</span>
                <span class="info-box-number" style="color: red">
                    {{$loan_overdue_stats}}

                </span>
            </div>

        </div>
    </div>

    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon elevation-1" style="color:#6e4b4b"><i class="fas fa-cog"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Loans Due</span>
                <span class="info-box-number" style="color:blue">
                    {{$loan_due_stats}}

                </span>
            </div>

        </div>
    </div>
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon elevation-1" style="color:#6e4b4b"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Customers</span>
                <span class="info-box-number">
                    {{$customers_stats}}

                </span>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Loan Pending Approval Requests</h3>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped reduce_padding">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Telephone</th>
                                <th>Loan Amount</th>
                                <th>Disbursed</th>
                                <th>Intrest</th>
                                <th>Application Date</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loans_pending_requests as $key=>$loan)
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

</div>



{{-- <div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Latest Loan Repayments Transactions</h3>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped display nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Telephone</th>
                                <th>Paid Amount</th>
                                <th>Balance</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>--}}

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<style>
    .reduce_padding td,
    .reduce_padding th {
        padding: 5px !important;
    }
</style>
@stop

@section('js')

<script>

</script>
@stop