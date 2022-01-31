@extends('adminlte::page')
@section('title', 'Show Job Card')

@section('content')
@include('notices')


<div class="card card-default color-palette-box">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-box-open"></i>
            Show Job Card
        </h3>


        <a href="/job_cards/{{$job_card->id}}/edit" class="btn btn-secondary btn-sm"
            style="float:right; margin-left:10px"><i class="fas fa-edit"></i> EDIT JOB CARD</a>

        <a href="/job_card/print_jobcard/{{$job_card->id}}" target="_blank" class="btn btn-secondary btn-sm"
            style="float:right"><i class="fas fa-file"></i> PRINT PDF</a>
    </div>
    <div class="card-body">
        <h5>Product Details</h5>
        <table class="table table-bordered table-striped">
            <tr>
                <th>Job Card No.</th>
                <th>Product Serial No.</th>
                <th>Name</th>
                <th>Category/Model</th>
                <th>Date</th>
                <th>Overall Status</th>
            </tr>

            <tr>
                <td>#{{\Carbon\Carbon::parse($job_card->created_at)->format("Y/m/d")}}/{{$job_card->id}}</td>
                <td>{{$job_card->product_serial}}</td>
                <td>{{$job_card->product_type_name}}</td>
                <td>{{$job_card->category_name}} / {{$job_card->product_model_name}}</td>
                <td>{{\Carbon\Carbon::parse($job_card->date_brought)->format("d-m-Y")}}</td>
                <td><span class="badge badge-{{$job_card->color_code}}">{{$job_card->job_card_status_name}}</span></td>
            </tr>

            <tr>

                <th>Payment Method</th>
                <th>Pri. Telephone</th>
                <th>Sec. Telephone</th>
                <th>Email</th>
                <th>Received By</th>
                <th>Last Update</th>
            </tr>

            <tr>
                <td>{{$job_card->payment_method}} </td>
                <td>{{$job_card->primary_telephone}}</td>
                <td>{{$job_card->secondary_telephone}}</td>
                <td>{{$job_card->email}}</td>
                <td>{{$job_card->received_by}}</td>
                <td>{{\Carbon\Carbon::parse($job_card->updated_at)->format("d-m-Y")}}</td>
            </tr>
        </table>

        <hr />

        <div class="row">

            <div class="col-md-6">

                <h5> Product Problem/condition Description(Notes)</h5>
                {!! $job_card->description !!}

            </div>

            <div class="col-md-6">
                <h5>Product Documents <a href="" class="btn btn-xs btn-default" data-toggle="modal"
                        data-target="#modal-add_document">ADD NEW</a></h5>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Serial No.</th>
                        <th>Issued Date</th>
                        <th>Period</th>
                    </tr>

                    @foreach ($documents as $key=>$document)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$document->document_type_name}}</td>
                        <td>{{$document->serial_no}}</td>
                        <td>{{\Carbon\Carbon::parse($document->issued_date)->format("d-M-Y")}}</td>
                        <td>{{$document->validity_period}} {{$document->validity_period_name}}</td>
                    </tr>

                    @endforeach


                </table>

            </div>
        </div>

        <hr />

        <h5>Job Card History</h5>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Description/Diagnostic Notes</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Modify</th>
                </tr>
            </thead>

            <tbody>

                @foreach($job_card_histories as $history)
                <tr>
                    <td>{{\Carbon\Carbon::parse($history->created_at)->format("d-M-Y g:i:s a")}}</td>
                    <td>{{$history->description}}</td>
                    <td>{{$history->name}}</td>
                    <td><span class="badge badge-{{$history->color_code}}">{{$history->job_card_status_name}}</span>
                    </td>
                    <td>
                        <a href="" data-toggle="modal" data-target="#modal-edit-{{$history->id}}" title="Edit Details"
                            class="btn btn-xs btn-secondary"><strong> <i class="fas fa-edit"></i></strong>
                        </a>
                    </td>
                </tr>


                <div class="modal fade" id="modal-edit-{{$history->id}}">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Details</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                {!!
                                Form::open(['action'=>'JobCardController@update_history','method'=>'POST','class'=>'form
                                user_form',
                                'enctype'=>'multipart/form-data'])
                                !!}
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            {{Form::label('update_description', 'Enter Diagnostic Notes/Description')}}
                                            {{Form::textarea('update_description',
                                            $history->description,['class'=>'form-control',
                                            'placeholder'=>'','required'=>'required','style'=>'height:130px'])}}
                                        </div>
                                    </div>

                                    <div class="col-md-4">


                                        <div class="form-group">
                                            {{Form::label('update_date', 'Date*')}}
                                            {{Form::text('update_date',
                                            \Carbon\Carbon::parse($history->job_card_date)->format("d-m-Y"),['class'=>'date_selector
                                            form-control',
                                            'placeholder'=>'','required'=>'required','autocomplete'=>'off'])}}
                                        </div>

                                        <div class="form-group">
                                            {{Form::label('update_status', 'Status* ',['class'=>'control-label'])}}
                                            {{ Form::select('update_status', $statuses,$history->status_id,
                                            ['style'=>'width:100%','class' =>
                                            'select2
                                            form-control','placeholder'=>'--Specify--']) }}
                                        </div>






                                    </div>

                                    <div class="col-md-12">
                                        <input type="hidden" name="history_id" value="{{$history->id}}">
                                        <button type="submit" class="btn btn-secondary"><strong> UPDATE
                                                DETAILS</strong></button>
                                    </div>

                                </div>

                                {!! Form::close() !!}
                            </div>

                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

                @endforeach
            </tbody>

        </table>
        <hr />


        {!!
        Form::open(['action'=>'JobCardController@store_history','method'=>'POST','class'=>'form user_form',
        'enctype'=>'multipart/form-data'])
        !!}
        <h5>Status/Diagnostic Notes/Description</h5>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    {{Form::label('description', 'Enter Diagnostic Notes/Description')}}
                    {{Form::textarea('description', null,['class'=>'form-control',
                    'placeholder'=>'','required'=>'required','style'=>'height:130px'])}}
                </div>
            </div>

            <div class="col-md-4">


                <div class="form-group">
                    {{Form::label('date', 'Date*')}}
                    {{Form::text('date', null,['class'=>'form-control date_selector',
                    'placeholder'=>'','required'=>'required','autocomplete'=>'off'])}}
                </div>

                <div class="form-group">
                    {{Form::label('history_status', 'Status* ',['class'=>'control-label'])}}
                    {{ Form::select('history_status', $statuses,null,
                    ['style'=>'width:100%','class' =>
                    'select2
                    form-control','placeholder'=>'--Specify--']) }}
                </div>



            </div>

            <div class="col-md-12">
                <input type="hidden" name="job_card_id" value="{{$job_card->id}}">
                <button type="submit" class="btn btn-secondary"><strong> SUBMIT DETAILS</strong></button>
            </div>

        </div>
        {!! Form::close() !!}



    </div>
    <div class="card-footer">

    </div>
</div>

<div class="modal fade" id="modal-add_document">
    <div class="modal-dialog modal-lg">
        {!!
        Form::open(['action'=>'DocumentController@store','method'=>'POST','class'=>'form user_form',
        'enctype'=>'multipart/form-data'])
        !!}
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ADD DOCUMENT</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{Form::label('document_type', 'Select Document Type* ',['class'=>'control-label'])}}
                            {{ Form::select('document_type', $document_types,null,
                            ['style'=>'width:100%','class' =>
                            'select2
                            form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::label('serial_no', 'Serial No* ')}}
                            {{Form::text('serial_no', null,['class'=>'form-control',
                            'placeholder'=>'','required'=>'required'])}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::label('issued_date', 'Issued Date* ')}}
                            {{Form::text('issued_date', null,['class'=>'form-control',
                            'placeholder'=>'','required'=>'required','autocomplete'=>'off'])}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::label('validity_period', 'Validity Period* ')}}
                            {{Form::number('validity_period', null,['class'=>'form-control',
                            'placeholder'=>'','required'=>'required'])}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::label('validity_type', 'Validity Type* ',['class'=>'control-label'])}}
                            {{ Form::select('validity_type', $validity_periods,null,
                            ['style'=>'width:100%','class' =>
                            'select2
                            form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" name="product_id" value="{{$job_card->product_id}}">
                <button type="submit" class="btn btn-secondary">SUBMIT</button>
            </div>
        </div>
        <!-- /.modal-content -->

        {!! Form::close() !!}
    </div>
    <!-- /.modal-dialog -->
</div>



@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">

<style>
    td,
    th {
        padding: 5px !important
    }
</style>
@stop

@section('js')

<script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script>
    $(function () {
            $("#example1").DataTable({
                // "responsive": false,
                "autoWidth": false,
                 "ordering": false,
                "rowReorder": {
                "selector": 'td:nth-child(3)'
                },
                "responsive": true,
            });

            $('.date_selector').datepicker({
                autoclose: true,
                format: 'dd-mm-yyyy'
            });

            $('#issued_date').datepicker({
                autoclose: true,
                format: 'dd-mm-yyyy'
            });

       
        });
    
</script>
@stop