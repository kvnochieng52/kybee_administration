@extends('adminlte::page')
@section('title', 'View Loan')


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
                <table id="example1" class="table table-bordered table-striped ">
                    <thead>

                        <tr>

                            <th>Name</th>
                            <th>Telephone</th>
                            <th>Loan Amount</th>
                            <th>Disbursed</th>
                            <th>Intrest</th>
                            <th>Application Date</th>
                            <th>Due Date</th>
                            <th>Status</th>
                        </tr>

                    </thead>


                    <tbody>

                        <tr>
                            <td>{{$loan->first_name}} {{$loan->middle_name}} {{$loan->last_name}}</td>
                            <td>{{$loan->telephone}}</td>
                            <td>Ksh {{$loan->total_amount}}</td>
                            <td>Ksh {{$loan->disbursed}}</td>
                            <td>Ksh {{$loan->interest+$loan->commission}}</td>
                            <td> {{\Carbon\Carbon::parse($loan->application_date)->format("d-F-Y")}}</td>
                            <td> {{\Carbon\Carbon::parse($loan->due_date)->format("d-F-Y")}}</td>
                            <td><span
                                    class="badge badge-{{$loan->loan_status_id==2? 'success' : 'primary' }}">{{$loan->loan_status_name}}</span>
                            </td>

                        </tr>

                    </tbody>

                </table>

                <hr />


                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-four-details-tab" data-toggle="pill"
                                    href="#custom-tabs-four-details" role="tab" aria-controls="custom-tabs-four-details"
                                    aria-selected="true"><strong><i class="fas fa-info-circle"></i>BASIC
                                        DETAILS</strong></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-phone_book-tab" data-toggle="pill"
                                    href="#custom-tabs-four-phone_book" role="tab"
                                    aria-controls="custom-tabs-four-phone_book" aria-selected="false"><i
                                        class="fas fa-mobile"></i>
                                    PHONE BOOK</a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill"
                                    href="#custom-tabs-four-messages" role="tab"
                                    aria-controls="custom-tabs-four-messages" aria-selected="false"><i
                                        class="fas fa-envelope"></i> MESSAGES</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-loans-tab" data-toggle="pill"
                                    href="#custom-tabs-four-loans" role="tab" aria-controls="custom-tabs-four-loans"
                                    aria-selected="false"><i class="fas fa-money-bill"></i>
                                    LOANS</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-documents-tab" data-toggle="pill"
                                    href="#custom-tabs-four-documents" role="tab"
                                    aria-controls="custom-tabs-four-documents" aria-selected="false"><i
                                        class="fas fa-file"></i>
                                    DOCUMENTS</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-four-details" role="tabpanel"
                                aria-labelledby="custom-tabs-four-details-tab">
                                @include('admin.user.show._basic_details')
                            </div>

                            <div class="tab-pane fade" id="custom-tabs-four-phone_book" role="tabpanel"
                                aria-labelledby="custom-tabs-four-phone_book-tab">
                                @include('admin.user.show._phone_book')
                            </div>

                            <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel"
                                aria-labelledby="custom-tabs-four-messages-tab">
                                @include('admin.user.show._messages')
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-loans" role="tabpanel"
                                aria-labelledby="custom-tabs-four-loans-tab">
                                @include('admin.user.show._loans')
                            </div>

                            <div class="tab-pane fade" id="custom-tabs-four-documents" role="tabpanel"
                                aria-labelledby="custom-tabs-four-documents-tab">
                                @include('admin.user.show._documents')
                            </div>

                        </div>
                    </div>
                </div>

                {!!
                Form::open(['action'=>['LoanController@update',$loan->id],'method'=>'POST','class'=>'form
                user_form','enctype'=>'multipart/form-data'])
                !!}


                <div class="row">
                    <div class="col-md-5">

                        <div class="form-group">
                            {{Form::label('approve_decline', 'Approve/Decline* ',['class'=>'control-label'])}}
                            {{ Form::select('approve_decline', $loan_statuses,$loan->loan_status_id,
                            ['style'=>'width:100%','class' =>
                            'select2
                            form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>

                    </div>


                    <div class="col-md-7">

                        <div class="form-group">
                            {{Form::label('reason', 'Reason')}}
                            <div class="form-group">
                                {{Form::textarea('reason', null,['class'=>'form-control',
                                'placeholder'=>'Enter Reason','style'=>'height:90px'])}}
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-secondary"><strong> UPDATE DETAILS</strong></button>
                    </div>
                </div>
            </div>


            {{Form::hidden('_method','PUT')}}

            {!! Form::close() !!}
        </div>
    </div>
</div>


</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<style>
    .reduce_padding td,
    .reduce_padding th {
        padding: 3px !important;
    }

    .content {
        word-wrap: break-word;
        /*old browsers*/
        overflow-wrap: break-word;
    }

    .overflow-wrap-hack {
        max-width: 1px;
    }
</style>
@stop

@section('js')
<script src="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

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