@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content')
@include('notices')

{!!
Form::open(['action'=>'ProductController@store','method'=>'POST','class'=>'form user_form',
'enctype'=>'multipart/form-data'])
!!}
<div class="card card-default color-palette-box">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-box-open"></i>
            Show Product
        </h3>
    </div>
    <div class="card-body">
        <h5>Product Details</h5>
        <table class="table table-bordered table-striped">
            <tr>
                <th>Product Serial No.</th>
                <th>Name</th>
                <th>Model</th>
                <th>Category</th>
            </tr>

            <tr>
                <td>HFSTRVS</td>
                <td>Hisense TV</td>
                <td>HRTGB</td>
                <td>Smart Tv</td>
            </tr>

            <tr>
                <th colspan="4">Description</th>
            </tr>

            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
        </table>

        <hr />

        <div class="row">

            <div class="col-md-6">
                <h5>Product Assignment

                    <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal"
                        data-target="#modal-assign_product">
                        <b>ASSIGN PRODUCT</b>
                    </button>

                </h5>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Assigned to</th>
                        <th>User</th>
                    </tr>

                    <tr>
                        <td>1</td>
                        <td>10-Jan-2021</td>
                        <td>MANMAR ELECTRONICS (Distributor)</td>
                        <td>Kevin Ochieng</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>12-Oct-2021</td>
                        <td>SOFT ENTERPRISES (Retailer)</td>
                        <td>John Mwangi</td>
                    </tr>

                </table>



            </div>

            <div class="col-md-6">
                <h5>Product Documents <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal"
                        data-target="#modal-add_document">
                        <b>ADD NEW</b>
                </h5>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Serial No.</th>
                        <th>Issued Date</th>
                        <th>Period</th>
                    </tr>

                    <tr>
                        <td>1</td>
                        <td>Warranty</td>
                        <td>SRHKDHVDHD</td>
                        <td>11-November-2020</td>
                        <td>1 Year</td>
                    </tr>

                </table>

            </div>
        </div>

        <h5>Product History</h5>
        <table class="table table-bordered table-striped">
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Descrition</th>
                <th>User</th>
            </tr>

            <tr>
                <td>10-Jan-2021</td>
                <td>Assignment</td>
                <td>Assigned to: MANMAR ELECTRONICS (Distributor)</td>
                <td>Kevin Ochieng</td>
            </tr>

            <tr>
                <td>10-Jan-2021</td>
                <td>Assignment</td>
                <td>Assigned to: SOFT ENTERPRISES (Retailer)</td>
                <td>John Mwangi</td>
            </tr>
            <tr>
                <td>12-Oct-2021</td>
                <td>Job Card/Service</td>
                <td>Job Card Created #685</td>
                <td>John Doe</td>
            </tr>

        </table>
        <hr />









    </div>
    <div class="card-footer">

    </div>
</div>


<div class="modal fade" id="modal-assign_product">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Assign product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><b>Assign Product to:</b></p>

                <div class="row">
                    <div class="col-md-4">
                        <div class="icheck-primary d-inline">
                            <label for="business">
                                <input type="radio" id="business" name="customer_type" value="business"
                                    class="customer_type">
                                &nbsp; Business

                            </label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="icheck-primary d-inline">

                            <label for="customer">
                                <input type="radio" id="customer" name="customer_type" value="customer"
                                    class="customer_type">
                                &nbsp; Customer

                            </label>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row">

                    <div class="col-md-12">

                        <div class="business_wrap customer_type_wrap">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{Form::label('Name', 'Date* ')}}
                                        {{Form::date('Name', null,['class'=>'form-control',
                                        'placeholder'=>'','required'=>'required'])}}
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{Form::label('model', 'Select Business* ',['class'=>'control-label'])}}
                                        {{ Form::select('model', ['1254: MANMAR ELECTRONICS (Distributor)','4525: SOFT
                                        ENTERPRISES (Retailer)', '1254: CHANDARANA SUPPLIERS(Sales
                                        Agent)'],null,
                                        ['style'=>'width:100%','class' =>
                                        'select2
                                        form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="customer_wrap customer_type_wrap">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('Name', 'Date* ')}}
                                        {{Form::date('Name', null,['class'=>'form-control',
                                        'placeholder'=>'','required'=>'required'])}}
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{Form::label('Name', 'Customer Name* ')}}
                                        {{Form::text('Name', null,['class'=>'form-control',
                                        'placeholder'=>'','required'=>'required'])}}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{Form::label('Name', 'Telephone* ')}}
                                        {{Form::text('Name', null,['class'=>'form-control',
                                        'placeholder'=>'','required'=>'required'])}}
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{Form::label('Name', 'Email* ')}}
                                        {{Form::text('Name', null,['class'=>'form-control',
                                        'placeholder'=>'','required'=>'required'])}}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{Form::label('Name', 'Address* ')}}
                                        {{Form::text('Name', null,['class'=>'form-control',
                                        'placeholder'=>'','required'=>'required'])}}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary">SUBMIT</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>


<div class="modal fade" id="modal-add_document">
    <div class="modal-dialog modal-lg">
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
                            {{Form::label('model', 'Select Document Type* ',['class'=>'control-label'])}}
                            {{ Form::select('model', ['Warranty','Insurance'],null,
                            ['style'=>'width:100%','class' =>
                            'select2
                            form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::label('Name', 'Serial No* ')}}
                            {{Form::text('Name', null,['class'=>'form-control',
                            'placeholder'=>'','required'=>'required'])}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::label('Name', 'Issued Date* ')}}
                            {{Form::date('Name', null,['class'=>'form-control',
                            'placeholder'=>'','required'=>'required'])}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::label('Name', 'Validity Period* ')}}
                            {{Form::text('Name', null,['class'=>'form-control',
                            'placeholder'=>'','required'=>'required'])}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::label('model', 'Validity Type* ',['class'=>'control-label'])}}
                            {{ Form::select('model', ['Year(s)','Months(s)','Day(s)'],null,
                            ['style'=>'width:100%','class' =>
                            'select2
                            form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">SUBMIT</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

{!! Form::close() !!}

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

    .customer_type_wrap {
        display: none
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


            $('.customer_type').change(function(){
                var selected_option=$(this).val();
                $('.customer_type_wrap').hide();
                $('.'+selected_option+'_wrap').show();
            });

       
        });
    
</script>
@stop