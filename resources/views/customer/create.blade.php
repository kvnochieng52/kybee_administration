@extends('adminlte::page')
@section('title', 'New Business')

@section('content')
@include('notices')

{!!
Form::open(['action'=>'CustomerController@store','method'=>'POST','class'=>'form user_form',
'enctype'=>'multipart/form-data'])
!!}
<div class="card card-default color-palette-box">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-user-plus"></i>
            New Customer
        </h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            {{Form::label('first_name', 'First Name*')}}
                            {{Form::text('first_name', null,['class'=>'form-control',
                            'placeholder'=>'Customer Last Name','required'=>'required'])}}
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            {{Form::label('last_name', 'Last Name* ')}}
                            {{Form::text('last_name', null,['class'=>'form-control',
                            'placeholder'=>'Customer Last Name','required'=>'required'])}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" name="full_number">
                        <div class="form-group">

                            {{Form::label('primary_telephone', 'Primary Telephone*')}}<br />
                            {{Form::text('primary_telephone', null,['class'=>'form-control','required'=>'required'])}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <input type="hidden" name="full_number_secondary">
                        <div class="form-group">
                            {{Form::label('secondary_telephone', 'Secondary Telephone')}}
                            {{Form::text('secondary_telephone', null,['class'=>'form-control'])}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            {{Form::label('email', 'Email')}}
                            {{Form::email('email', null,['class'=>'form-control',
                            'placeholder'=>'Customers Email'])}}
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            {{Form::label('district', 'District* ',['class'=>'control-label'])}}
                            {{ Form::select('district', $districts,null,
                            ['style'=>'width:100%','class' =>
                            'select2
                            form-control','placeholder'=>'--Specify--', 'required'=>'required']) }}
                        </div>

                    </div>

                </div>

                <div class="row">



                    {{--
                    <div class="col-md-6">

                        <div class="form-group">
                            {{Form::label('town', 'Town ',['class'=>'control-label'])}}
                            {{ Form::select('town', $towns,null,
                            ['style'=>'width:100%','class' =>
                            'select2
                            form-control','placeholder'=>'--Specify--']) }}
                        </div>

                    </div> --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::label('address', 'Address*')}}
                            {{Form::textarea('address', null,['class'=>'form-control',
                            'placeholder'=>'','style'=>'height:50px', 'required'=>'required'])}}
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="card-footer">
        <div class="row">

            <div class="col-md-8">
                <button type="submit" class="btn btn-secondary"><strong> SUBMIT DETAILS</strong></button>
            </div>
        </div>
    </div>
</div>

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

        var input = document.querySelector("#primary_telephone");
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



        var input = document.querySelector("#secondary_telephone");
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
        hiddenInput: "full_number_secondary",
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