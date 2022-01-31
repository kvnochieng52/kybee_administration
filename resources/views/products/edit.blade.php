@extends('adminlte::page')
@section('title', 'Edit Product')

@section('content')
@include('notices')

{!!
Form::open(['action'=>['ProductController@update',$product->id],'method'=>'POST','class'=>'form
user_form','enctype'=>'multipart/form-data'])
!!}

<div class="card card-default color-palette-box">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-box-open"></i>
            Edit product
        </h3>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-9">

                        <div class="form-group">
                            {{Form::label('serial_no', 'Product Serial No*')}}
                            {{Form::text('serial_no', $product->product_serial,['class'=>'form-control',
                            'placeholder'=>'','required'=>'required'])}}
                        </div>
                        <div class="search_msgs"></div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4">

                        <div class="form-group">
                            {{Form::label('product_type', 'Product type* ',['class'=>'control-label'])}}
                            {{ Form::select(
                            'product_type',
                            $product_types,
                            $product->product_type_id,
                            ['style'=>'width:100%',
                            'class' =>'product_type form-control select2',
                            'placeholder'=>'--Specify--',
                            'required'=>'required']) }}
                        </div>
                    </div>

                    <div class="col-md-4">

                        <div class="form-group">
                            {{Form::label('category', 'Category* ',['class'=>'control-label'])}}
                            {{ Form::select('category', [$product->category_id=>$product->category_name],null,
                            ['style'=>'width:100%','class' =>
                            'category select2
                            form-control','required'=>'required']) }}
                        </div>
                    </div>

                    <div class="col-md-4">

                        <div class="form-group">
                            {{Form::label('model', 'Model* ',['class'=>'control-label model'])}}
                            {{ Form::select('model',[$product->model_id=>$product->product_model_name],null,
                            ['style'=>'width:100%','class'
                            =>'form-control select2 model']) }}
                        </div>
                    </div>
                </div>

                <div class="row">


                    <div class="col-md-12">
                        <div class="form-group">
                            {{Form::label('description', 'Description(optional)')}}
                            {{Form::textarea('description', $product->description,['class'=>'form-control',
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
                <button type="submit" class="btn btn-secondary"><strong> UPDATE DETAILS</strong></button>
            </div>
        </div>
    </div>
</div>

{{Form::hidden('_method','PUT')}}

{!! Form::close() !!}

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link href="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet">
@stop

@section('js')
<script src="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
    $(function () {

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
           
    })
</script>
@stop