@extends('adminlte::page')
@section('title', 'New Business')

@section('content')
@include('notices')

{!!
Form::open(['action'=>['BusinessController@update',$business->id],'method'=>'POST','class'=>'form
user_form','enctype'=>'multipart/form-data'])
!!}

<div class="card card-default color-palette-box">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-box-open"></i>
            Edit Business
        </h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            {{Form::label('business_name', 'Business Name*')}}
                            {{Form::text('business_name', $business->business_name,['class'=>'form-control',
                            'placeholder'=>'','required'=>'required'])}}
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            {{Form::label('contact_person', 'Contact Person* ')}}
                            {{Form::text('contact_person', $business->contact_person,['class'=>'form-control',
                            'placeholder'=>'','required'=>'required'])}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            {{Form::label('email', 'Email')}}
                            {{Form::email('email', $business->email,['class'=>'form-control',
                            'placeholder'=>''])}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <input type="hidden" name="full_number">
                        <div class="form-group">
                            {{Form::label('telephone', 'Telephone* ')}}<br />
                            {{Form::text('telephone', $business->telephone,['class'=>'form-control',
                            'placeholder'=>'','required'=>'required'])}}
                        </div>
                    </div>
                </div>

                <div class="row">


                    <div class="col-md-6">

                        <div class="form-group">
                            {{Form::label('district', 'District*',['class'=>'control-label'])}}
                            {{ Form::select('district', $districts,$business->district,
                            ['style'=>'width:100%','class' =>
                            'select2
                            form-control','placeholder'=>'--Specify--','required'=>true]) }}
                        </div>

                    </div>

                    {{-- <div class="col-md-6">

                        <div class="form-group">
                            {{Form::label('town', 'Town ',['class'=>'control-label'])}}
                            {{ Form::select('town', $towns,$business->town,
                            ['style'=>'width:100%','class' =>
                            'select2
                            form-control','placeholder'=>'--Specify--']) }}
                        </div>

                    </div> --}}

                </div>

                <div class="row">


                    <div class="col-md-6">

                        <div class="form-group">
                            {{Form::label('type', 'Type* ',['class'=>'control-label'])}}
                            {{ Form::select('type', $roles,$business->type,
                            ['style'=>'width:100%','class' =>
                            'select2
                            form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>

                    </div>

                    {{-- <div class="col-md-6">

                        <div class="form-group">
                            {{Form::label('status', 'Status* ',['class'=>'control-label'])}}
                            {{ Form::select('status', ['1'=>'Active','2'=>'In-active'],null,
                            ['style'=>'width:100%','class' =>
                            'select2
                            form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>

                    </div> --}}

                </div>



                <div class="row">


                    <div class="col-md-12">
                        <div class="form-group">
                            {{Form::label('address', 'Address(optional)')}}
                            {{Form::textarea('address', $business->address,['class'=>'form-control',
                            'placeholder'=>'','style'=>'height:70px'])}}
                        </div>
                    </div>
                </div>

                <div class="row">


                    <div class="col-md-12">
                        <div class="form-group">
                            {{Form::label('description', 'Description(optional)')}}
                            {{Form::textarea('description', $business->description,['class'=>'form-control',
                            'placeholder'=>'','style'=>'height:90px'])}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card-footer">
        <div class="row">

            <div class="col-md-8">
                <button type="submit" class="btn btn-secondary"><strong> EDIT DETAILS</strong></button>
            </div>
        </div>
    </div>
</div>
{{Form::hidden('_method','PUT')}}
{!! Form::close() !!}

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="/build/css/intlTelInput.css">
@stop

@section('js')
<script src="/build/js/intlTelInput.js"></script>

<script>
    $(function () {
        
        var input = document.querySelector("#telephone");
        window.intlTelInput(input, {
        // allowDropdown: false,
        // autoHideDialCode: false,
        // autoPlaceholder: "off",
        // dropdownContainer: document.body,
        // excludeCountries: ["us"],
        // formatOnDisplay: false,
        // geoIpLookup: function(callback) {
        // $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
        // var countryCode = (resp && resp.country) ? resp.country : "";
        // callback(countryCode);
        // });
        // },
        hiddenInput: "full_number",
        initialCountry: "ug",
        // localizedCountries: { 'de': 'Deutschland' },
        // nationalMode: false,
        // onlyCountries: ['ug', 'ke', 'tz', 'ca','ch'],
        placeholderNumberType: "MOBILE",
        preferredCountries: ['ug', 'ke','tz'],
        // separateDialCode: true,
        utilsScript: "/build/js/utils.js",
        });
        $('.select2').select2()
           
        })
</script>
@stop