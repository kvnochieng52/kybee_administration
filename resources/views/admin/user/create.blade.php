@extends('adminlte::page')

@section('title', 'New User')

@section('content')

@include('notices')
{!!
Form::open(['action'=>'Admin\\UserController@store','method'=>'POST','class'=>'form
user_form','enctype'=>'multipart/form-data'])
!!}
<div class="card">
    <div class="card-header">
        <h3 class="card-title">New User</h3>
    </div>

    <div class="card-body">

        <div class="row">
            <div class="col-md-12">
                {{Form::label('full_names', 'Full Names* ')}}
                <div class="form-group">
                    {{Form::text('full_names', '',['class'=>'form-control', 'placeholder'=>'User Full Names',
                    'required'=>'required'])}}
                </div>
            </div>



        </div>

        <div class="row">

            <div class="col-md-4">
                {{Form::label('email', 'Email')}}
                <div class="form-group">
                    {{Form::email('email', '',['class'=>'form-control', 'placeholder'=>'Enter The user Email',
                    'required'=>'required'])}}
                </div>
            </div>

            <div class="col-md-4">
                {{Form::label('password', 'Password* ')}}
                <div class="form-group">
                    {{Form::password('password',['class'=>'form-control', 'placeholder'=>'Enter a strong Password',
                    'required'=>'required'])}}
                </div>
            </div>

            <div class="col-md-4">
                {{Form::label('password_confirmation', 'Confirm Password* ')}}
                <div class="form-group">
                    {{Form::password('password_confirmation',['class'=>'form-control', 'placeholder'=>'Enter a strong
                    Password',
                    'required'=>'required'])}}
                </div>
            </div>

            <div class="col-md-4">
                {{Form::label('telephone', 'Telephone* ')}}
                <div class="form-group">
                    {{Form::text('telephone', '',['class'=>'form-control', 'placeholder'=>'User Telephpone',
                    'required'=>'required'])}}
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-4">

                {{Form::label('role', 'Role')}}

                <div class="form-group">
                    {{ Form::select('role', $roles,null, ['class' =>
                    'form-control','placeholder'=>'--None--','required'=>'required']) }}
                </div>

            </div>



            <div class="col-md-4">
                <div class="form-group">
                    {{Form::label('business', 'Select Business(if Distributor, Retailer, Sales Agent,
                    showroom)',['class'=>'control-label'])}}
                    {{ Form::select('business', $businesses,null,
                    ['style'=>'width:100%','class' =>
                    'select2
                    form-control','placeholder'=>'--Specify--']) }}
                </div>
            </div>



            <div class="col-md-4">

                {{Form::label('is_active', 'Active*')}}

                <div class="form-group">
                    {{ Form::select('is_active', ['in Active', 'Active'],null, ['class' =>
                    'form-control','placeholder'=>'--Select--','required'=>'required']) }}
                </div>

            </div>



        </div>





        <button type="submit" class="btn btn-secondary">SUBMIT DETAILS</button>




    </div>
</div>
{!! Form::close() !!}
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="/css/validator/bootstrapValidator.min.css" />
@stop

@section('js')
<script type="text/javascript" src="/js/validator/bootstrapValidator.min.js"></script>
<script>
    $(function () {

        $('.select2').select2();
        
      $('.user_form')
            .bootstrapValidator({
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