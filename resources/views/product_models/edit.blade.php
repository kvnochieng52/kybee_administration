@extends('adminlte::page')
@section('title', 'Edit Product Model')

@section('content')
@include('notices')

<div class="card card-default color-palette-box">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-box-open"></i>
            Edit Product Model
        </h3>
    </div>
    <div class="card-body">

        {!!
        Form::open(['action'=>['ProductModelController@update',$product_model->id],'method'=>'POST','class'=>'form
        user_form','enctype'=>'multipart/form-data'])
        !!}


        <div class="row">

            <div class="col-md-6">


                <div class="form-group">
                    {{Form::label('product_type', 'Product Type* ',['class'=>'control-label'])}}
                    {{ Form::select('product_type',
                    $product_types,$product_model->product_type_id,['style'=>'width:100%','class'
                    =>'select2
                    form-control','placeholder'=>'--Select--','required'=>'required'])
                    }}
                </div>

            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {{Form::label('category', 'Category* ',['class'=>'control-label'])}}
                    {{ Form::select('category',
                    [$product_model->category_id=>$product_model->category_name],$product_model->category_id,['style'=>'width:100%','class'
                    =>'select2
                    form-control category','required'=>'required'])
                    }}
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6">


                <div class="form-group">
                    {{Form::label('product_model', 'Product Model Name (Comma separated if multiple)*')}}
                    {{Form::text('product_model', $product_model->product_model_name,['class'=>'form-control',
                    'placeholder'=>'Enter Product Model Name'])}}
                </div>

            </div>

            <div class="col-md-6">


                <div class="form-group">
                    {{Form::label('active', 'Active* ',['class'=>'control-label'])}}
                    {{ Form::select('active',
                    ['1'=>'Active','2'=>'In-Active'],$product_model->active,['style'=>'width:100%','class'
                    =>'select2
                    form-control','placeholder'=>'--Select--','required'=>'required'])
                    }}
                </div>

            </div>
        </div>

        <div class="row">

            <div class="col-md-10">
                <button type="submit" class="btn btn-secondary"><strong> UPDATE</strong></button>

            </div>
        </div>

        {{Form::hidden('_method','PUT')}}

        {!! Form::close() !!}

    </div>



    @stop

    @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">
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
       
        });
    
    </script>
    @stop