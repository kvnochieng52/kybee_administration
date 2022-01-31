@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content')
@include('notices')

{!!
Form::open(['action'=>'JobCardController@store','method'=>'POST','class'=>'form user_form',
'enctype'=>'multipart/form-data'])
!!}
<div class="card card-default color-palette-box">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-box-open"></i>
            New Job Card
        </h3>
    </div>
    <div class="card-body">


        <div class="row">
            <div class="col-md-4">

                <div class="form-group">
                    {{Form::label('date_of_report', 'Date of Report*')}}
                    {{Form::text('date_of_report', null,['class'=>'form-control date_select',
                    'placeholder'=>'','required'=>'required','autocomplete'=>'off'])}}
                </div>
            </div>
            <div class="col-md-4">

                <div class="form-group">
                    {{Form::label('date_of_completion', 'Date of Completion* ')}}
                    {{Form::text('date_of_completion', null,['class'=>'form-control date_select',
                    'placeholder'=>'','required'=>'required','autocomplete'=>'off'])}}
                </div>
            </div>

            <div class="col-md-4">

                <div class="form-group">
                    {{Form::label('date_of_return', 'Date of Return* ')}}
                    {{Form::text('date_of_return', null,['class'=>'form-control date_select',
                    'placeholder'=>'','required'=>'required','autocomplete'=>'off'])}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-9">

                        <div class="form-group">
                            {{Form::label('serial_no', 'Product Serial No*')}}
                            {{Form::text('serial_no', null,['class'=>'form-control',
                            'placeholder'=>'','required'=>'required'])}}
                        </div>
                        <div class="search_msgs"></div>
                    </div>
                    <div class="col-md-3" style="padding-top: 10px">
                        <br />
                        <button class="btn btn-default btn-sm btn-block search_serial"><strong><i
                                    class="fas fa-search"></i>
                                SEARCH</strong></button>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-4">

                        <div class="form-group">
                            {{Form::label('product_type', 'Product type* ',['class'=>'control-label'])}}
                            {{ Form::select(
                            'product_type',
                            $product_types,
                            null,
                            ['style'=>'width:100%',
                            'class' =>'product_type form-control select2',
                            'placeholder'=>'--Specify--',
                            'required'=>'required']) }}
                        </div>
                    </div>

                    <div class="col-md-4">

                        <div class="form-group">
                            {{Form::label('category', 'Category* ',['class'=>'control-label'])}}
                            {{ Form::select('category', [],null,
                            ['style'=>'width:100%','class' =>
                            'category select2
                            form-control','placeholder'=>'--Select Product Type 1st--','required'=>'required']) }}
                        </div>
                    </div>

                    <div class="col-md-4">

                        <div class="form-group">
                            {{Form::label('model', 'Model* ',['class'=>'control-label model'])}}
                            {{ Form::select('model',[],null,
                            ['style'=>'width:100%','class'
                            =>'form-control select2 model','placeholder'=>'--Select Product Category 1st--',]) }}
                        </div>
                    </div>
                </div>

                <div class="row">


                    <div class="col-md-4">

                        <div class="form-group">
                            {{Form::label('customer_name', 'Customer Name* ')}}
                            {{Form::text('customer_name', null,['class'=>'form-control',
                            'placeholder'=>'','required'=>'required'])}}
                        </div>
                    </div>


                    <div class="col-md-4">

                        <div class="form-group">
                            {{Form::label('receipt_no', 'Receipt No* ')}}
                            {{Form::text('receipt_no', null,['class'=>'form-control',
                            'placeholder'=>'','required'=>'required'])}}
                        </div>
                    </div>

                    <div class="col-md-4">

                        <div class="form-group">
                            {{Form::label('dealers_name', 'Dealers Name* ')}}
                            {{Form::text('dealers_name', null,['class'=>'form-control',
                            'placeholder'=>'','required'=>'required'])}}
                        </div>
                    </div>

                    <div class="col-md-4">

                        <div class="form-group">
                            {{Form::label('payment_method', 'Payment Method* ')}}
                            {{Form::text('payment_method', null,['class'=>'form-control',
                            'placeholder'=>'','required'=>'required'])}}
                        </div>
                    </div>

                    <div class="col-md-4">

                        <div class="form-group">
                            {{Form::label('date_of_purchase', 'Date of Purchase* ')}}
                            {{Form::text('date_of_purchase', null,['class'=>'form-control date_select',
                            'placeholder'=>'','required'=>'required'])}}
                        </div>
                    </div>

                    <div class="col-md-4">

                        <div class="form-group">
                            {{Form::label('customer_location', 'Customer Location* ')}}
                            {{Form::text('customer_location', null,['class'=>'form-control',
                            'placeholder'=>'','required'=>'required'])}}
                        </div>
                    </div>

                    <div class="col-md-4">

                        <div class="form-group">
                            {{Form::label('email', 'Email')}}
                            {{Form::email('email', null,['class'=>'form-control',
                            'placeholder'=>''])}}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <input type="hidden" name="full_number">
                        <div class="form-group">
                            {{Form::label('primary_telephone', 'Primary Tel* ')}}<br />
                            {{Form::text('primary_telephone', null,['class'=>'form-control',
                            'placeholder'=>'','required'=>'required'])}}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <input type="hidden" name="full_number_secondary">
                        <div class="form-group">
                            {{Form::label('secondary_telephone', 'Secondary Telephone ')}}
                            {{Form::text('secondary_telephone', null,['class'=>'form-control',
                            'placeholder'=>''])}}
                        </div>
                    </div>

                </div>


                <p><b>COLLECTION POINT</b></p>
                <label><input type="radio" name="collection_point" value="service_center"> SERVICE CENTER</label> &nbsp;
                &nbsp;&nbsp;
                <label><input type="radio" name="collection_point" value="on_site_location"> ON-SITE COLLECTION</label>
                &nbsp;&nbsp;
                <label><input type="radio" name="collection_point" value="others"> Others</label> <input type="text"
                    name="specify" placeholder="please specify if others...">





                <div class="row">


                    <div class="col-md-12">
                        <div class="form-group">
                            {{Form::label('description', 'Product Problem/condition Description*')}}
                            {{Form::textarea('description', null,['class'=>'form-control description_textbox',
                            'placeholder'=>'','style'=>'height:100px'])}}
                        </div>

                        <label><input type="radio" name="tech_notes" value="Technician sort out
                            the problem at the point of collection"> Technician sort out
                            the problem at the point of collection</label> &nbsp;
                        &nbsp;&nbsp;
                        <label><input type="radio" name="tech_notes" value="Stock collected at
                            the point of collection"> Stock collected at
                            the point of collection</label>
                        &nbsp;&nbsp;

                        <label><input type="radio" name="tech_notes" value="tock exchange at
                            the point of collection"> Stock exchange at
                            the point of collection</label>
                        &nbsp;&nbsp;
                        <label><input type="radio" name="tech_notes" value="Others"> Others</label> <input type="text"
                            name="specify" placeholder="please specify if others...">



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
<link href="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet">
<link rel="stylesheet" href="/build/css/intlTelInput.css">
@stop

@section('js')
<script src="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
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

        $('.select2').select2();
        $('.description_textbox').wysihtml5({
            toolbar: {
                "font-styles": false,
                "emphasis": true, 
                "lists": true, 
                "html": false, 
                "link": false, 
                "image": false,
                "color": false, 
                "blockquote": false, 
            }
        })

        $('#date').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });


        $('#product_type').change(function(){  
                $.ajax({
                    type:'GET',
                    url:'/category/product_categories_select',
                    data:{'type':$(this).val()},
                    success:function(data){
                        var $dropdown = $("#category");
                        $($dropdown)[0].options.length = 0;
                        $dropdown.append($("<option />").text('--Select Category--'));

                        $.each(data, function(index, element) {
                            $dropdown.append($("<option />").val(element.id).text(element.category_name));
                        });

                    },
                    error:function(e){}
                });
            });


             $('#category').change(function(){  
                $.ajax({
                    type:'GET',
                    url:'/product_model/product_model_select',
                    data:{'category_id':$(this).val()},
                    success:function(data){
                        var $dropdown = $("#model");
                        $($dropdown)[0].options.length = 0;
                        $dropdown.append($("<option />").text('--Select Model--'));

                        $.each(data, function(index, element) {
                            $dropdown.append($("<option />").val(element.id).text(element.product_model_name));
                        });

                    },
                    error:function(e){}
                });
            });



        $(".search_serial").click(function(e) {
           
            var serial=$('#serial_no').val();
            if(serial.length === 0){
                $('.search_msgs').html('<div style="color:red"><b>Please Enter serial No to Search.</b></div>')
            }else{
                 $(this).html('SEARCHING...PLEASE WAIT').prop('disabled', true)
                $.ajax({
                    type:'GET',
                    url:'/job_card/search_serial',
                    data:{'serial_no':$('#serial_no').val()},
                    success:function(data){
                      if(data.length===0){
                         $('.search_msgs').html('<div style="color:red"><b>Product with serial No. Not Found. Please  add other details to add product</b></div>')
                         $('.search_serial').html('SEARCH SERIAL').prop('disabled', false)
                    
                      }else{
                           $('.search_msgs').html('<div style="color:green"><b><i class="fas fa-check"></i>Product Found.</b></div>')



                            if(data.assigned_to==1){
                                 customer_name_field=data.business_name;
                                 customer_email_field=data.business_email;
                                 customer_primary_tel_field=data.business_telephone;
                                 customer_address_field=data.business_address;

                            }else{
                                 customer_name_field=data.first_name+ ' '+data.last_name;
                                 customer_email_field=data.customer_email;
                                 customer_primary_tel_field=data.customer_primary_telephone;
                                 customer_address_field=data.customer_address;
                            }



                            $('#customer_name').val(customer_name_field);
                            $('#email').val(customer_email_field);
                            $('#primary_telephone').val(customer_primary_tel_field);
                            $('#customer_location').val(customer_address_field);

                            

                            $('.product_type').empty();
                            $('.product_type').append($("<option />").val(data.product_type_id).text(data.product_type_name))
                            $('.product_type option[value="'+data.product_type_id+'"]').attr("selected", "selected");
                            $('.product_type').prop('readonly', true);

                            $('.category').empty();
                            $('.category').append($("<option />").val(data.category_id).text(data.category_name))
                            $('.category option[value="'+data.category_id+'"]').attr("selected", "selected");
                            $('.category').prop('readonly', true);

                            $('#model').empty();
                            $('#model').append($("<option />").val(data.model_id).text(data.product_model_name))
                            $('#model option[value="'+data.model_id+'"]').attr("selected", "selected");
                            $('#model').prop('readonly', true);

                           $('.search_serial').html('<b>SEARCH</b>').prop('disabled', false) 
                      }
                        
                    },
                    error:function(e){}
                });

            }

            e.preventDefault();
           
        })


         $('.date_select').datepicker({
                autoclose: true,
                format: 'dd-mm-yyyy'
            });
           
    })
</script>
@stop