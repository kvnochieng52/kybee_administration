@extends('adminlte::page')
@section('title', 'Show Product')

@section('content')
@include('notices')
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
                <th>Type</th>
                <th>Category</th>
                <th>Model</th>

            </tr>

            <tr>
                <td>{{$product->product_serial}}</td>
                <td>{{$product->product_type_name}}</td>
                <td>{{$product->category_name}}</td>
                <td>{{$product->product_model_name}}</td>
            </tr>

            <tr>
                <th colspan="4">Description</th>
            </tr>

            <tr>
                <td colspan="4">{{$product->description}}</td>
            </tr>
        </table>

        <hr />

        <div class="row">


            <div class="col-md-12">
                <h5>Product Documents <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal"
                        data-target="#modal-add_document">
                        <b>ADD NEW</b></button>
                </h5>
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

        <h5>Product History</h5>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Ownership</th>
                    <th>User</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($product_histories as $product_history)
                <tr>
                    <td>{{\Carbon\Carbon::parse($product_history->created_at)->format("d-M-Y g:i:s a")}}</td>
                    <td>{{$product_history->history_type_name}}</td>
                    <td>@if($product_history->history_type_id=='1')
                        @if($product_history->assign_type_name=='Business')
                        {{$product_history->business_name}} ({{$product_history->assign_type_name}})
                        @else
                        {{$product_history->first_name}}
                        {{$product_history->last_name}} ({{$product_history->assign_type_name}})
                        @endif
                        @endif


                        @if($product_history->history_type_id=='2')
                        Job card No: #{{$product_history->job_card_id}}
                        @endif

                    </td>
                    <td>{{$product_history->created_by_name}}</td>
                </tr>

                @endforeach

            </tbody>
        </table>
        <hr />









    </div>
    <div class="card-footer">

    </div>
</div>





@include('modal.products.modal_add_document')

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

            $('#issued_date').datepicker({
                autoclose: true,
                format: 'dd-mm-yyyy'
            });



            $('.customer_type').change(function(){
                var selected_option=$(this).val();
                $('.customer_type_wrap').hide();
                $('.'+selected_option+'_wrap').show();
            });

       
        });
    
</script>
@stop