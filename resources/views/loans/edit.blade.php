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
                <table id="example1" class="table table-bordered table-striped display nowrap">
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
@stop

@section('js')
<script src="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script>
    // $(function () {

    //      $('.terms_textbox').wysihtml5({
    //         toolbar: {
    //             "font-styles": true,
    //             "emphasis": true, 
    //             "lists": true, 
    //             "html": false, 
    //             "link": false, 
    //             "image": false,
    //             "color": false, 
    //             "blockquote": false, 
    //         }
    //     })

    // })

</script>
@stop