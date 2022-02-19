@extends('adminlte::page')

@section('title', 'Edit User')

{{-- @section('content_header')
<h1>Candidates</h1>
@stop --}}

@section('content')

@if(count($errors)>0)
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    @foreach($errors->all() as $error)
    {{$error}}<br>
    @endforeach
</div>
@endif


@if(session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{session('success')}}
</div>
@endif


@if(session('error'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{session('error')}}
</div>
@endif


<div class="card card-primary card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-four-details-tab" data-toggle="pill"
                    href="#custom-tabs-four-details" role="tab" aria-controls="custom-tabs-four-details"
                    aria-selected="true"><strong><i class="fas fa-info-circle"></i>BASIC DETAILS</strong></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-limit-tab" data-toggle="pill" href="#custom-tabs-four-limit"
                    role="tab" aria-controls="custom-tabs-four-limit" aria-selected="false"><i
                        class="fas fa-money-bill"></i>
                    LIMIT SETTINGS</a>
            </li>


            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-security-tab" data-toggle="pill"
                    href="#custom-tabs-four-security" role="tab" aria-controls="custom-tabs-four-security"
                    aria-selected="false"><i class="fas fa-cog"></i> SECURITY & PASSWORD</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-four-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-four-details" role="tabpanel"
                aria-labelledby="custom-tabs-four-details-tab">
                @include('admin.user.edit._basic_details')
            </div>

            <div class="tab-pane fade" id="custom-tabs-four-limit" role="tabpanel"
                aria-labelledby="custom-tabs-four-limit-tab">
                @include('admin.user.edit._limit')
            </div>

            <div class="tab-pane fade" id="custom-tabs-four-security" role="tabpanel"
                aria-labelledby="custom-tabs-four-security-tab">
                @include('admin.user.edit._security')
            </div>


        </div>
    </div>

</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet"
    href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css" />
@stop

@section('js')
<script src="https://oss.maxcdn.com/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
<script>
    $(function () {
    $('.slelct2').select2({});
    
    $('.date_select').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });
      $('.user_form')
            .bootstrapValidator({
                // Only disabled elements are excluded
                // The invisible elements belonging to inactive tabs must be validated
                excluded: [':disabled'],
                feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
                },
            })
   
    });
</script>
@stop