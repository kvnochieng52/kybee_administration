@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content')
@include('notices')

{!!
Form::open(['action'=>'ProductController@bulk_upload_process','method'=>'POST','class'=>'form user_form',
'enctype'=>'multipart/form-data'])
!!}
<div class="card card-default color-palette-box">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-box-open"></i>
            Products Bulk Upload
        </h3>
    </div>
    <div class="card-body">

        <div class="form-group">
            <label for="exampleInputFile">Upload CSV file with Products(Allowed format: CSV, Comma
                delimited)</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input csv_upload" id="csv_upload" name="csv_upload">
                    <label class="custom-file-label" for="csv_upload"> Select CSV file with
                        the products
                    </label>
                </div>

            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="row">

            <div class="col-md-10">
                <button type="submit" class="btn btn-secondary"><strong> SUBMIT DETAILS</strong></button>

            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<style>
    .selected_serials ul {
        list-style-type: none;
        padding-left: 0px
    }

    .selected_serials ul li {
        display: inline;
        margin-right: 10px;
    }
</style>
@stop

@section('js')
<script type="text/javascript" src="/vendor/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script>
    $(function () {
            bsCustomFileInput.init();
           
           
    })
</script>
@stop