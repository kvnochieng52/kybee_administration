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
            New Product
        </h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-12">
                        <p>Select Serial Source:&nbsp;

                            <label> <input type="radio" id="enter_serial" name="source" class="source"
                                    value="enter_serial" checked>
                                Enter Serial</label>
                            &nbsp;
                            &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                            <label> <input type="radio" id="upload_csv" name="source" class="source" value="upload_csv">
                                Upload
                                CSV</label>
                        </p>


                    </div>

                    <div class="col-md-12">

                        <div class="source_wrap enter_serial">
                            <div class="form-group">
                                {{Form::label('serial', 'Enter Serial Number(Comma separated if multiple)* ')}}
                                {{Form::textarea('serial', null,['class'=>'form-control',
                                'placeholder'=>'Enter the serial no','style'=>'height:100px'])}}
                            </div>
                        </div>

                        <div class="source_wrap upload_csv" style="display: none">
                            <div class="form-group">
                                <label for="exampleInputFile">Upload CSV file with Serials(Allowed format: CSV, Comma
                                    delimited)</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input csv_upload" id="csv_upload"
                                            name="csv_upload">
                                        <label class="custom-file-label" for="csv_upload"> Select CSV file with
                                            serials
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>





                    {{-- <div class="col-md-4">

                        <div class="form-group">
                            {{Form::label('serial', 'Serial Number* ')}}
                            {{Form::text('serial', null,['class'=>'form-control',
                            'placeholder'=>'Enter the serial no'])}}

                            <input type="hidden" id="selected_serials_field" name="selected_serials_field" value=""
                                class="selected_serials_field">
                        </div>
                    </div>
                    <div class="col-md-2" style="padding-top: 30px">
                        <button class="btn btn-link  add_serial"><i class="fa fa-fw fa-plus"></i> Add Serial</button>
                    </div> --}}
                </div>

                <div class="row">

                    <div class="col-md-12">
                        <div class="selected_serials">
                            <ul></ul>
                        </div>
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
                            {{ Form::select('category', [],null,['style'=>'width:100%','class' =>'select2
                            form-control category','placeholder'=>'--Select product type 1st--','required'=>'required'])
                            }}
                        </div>

                    </div>
                    <div class="col-md-4">

                        <div class="form-group">
                            {{Form::label('model', 'Model* ',['class'=>'control-label model'])}}
                            {{ Form::select('model',[],null,
                            ['style'=>'width:100%','class'
                            =>'form-control select2','placeholder'=>'--Select Product Category 1st--',]) }}
                        </div>
                    </div>
                </div>


                <div class="row">


                    <div class="col-md-12">
                        <div class="form-group">
                            {{Form::label('description', 'Description(optional)')}}
                            {{Form::textarea('description', null,['class'=>'form-control',
                            'placeholder'=>'','style'=>'height:90px'])}}
                        </div>
                    </div>
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
            $('.select2').select2()
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

           


        var serials_object=[];

        $(".add_serial").click(function(e) {
            e.preventDefault();
            var serial=$('#serial').val()
            serials_object.push(serial);

            $('#selected_serials_field').val(JSON.stringify(serials_object))

            $(".selected_serials ul").append('<li><span class="badge badge-primary">'+serial+'</li>');
            $('#serial').val('');
        });


        
        $('.source').change(function(){
            var selected_option=$(this).val();
            $('.source_wrap').hide();
            $('.'+selected_option).show();  
        });
           
    })
</script>
@stop