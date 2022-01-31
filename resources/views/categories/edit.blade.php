@extends('adminlte::page')
@section('title', 'New Product Category')

@section('content')
@include('notices')

<div class="card card-default color-palette-box">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-box-open"></i>
            Edit Product Category
        </h3>
    </div>
    <div class="card-body">


        {!!
        Form::open(['action'=>['CategoryController@update',$category->id],'method'=>'POST','class'=>'form
        user_form','enctype'=>'multipart/form-data'])
        !!}

        <div class="row">

            <div class="col-md-12">


                <div class="form-group">
                    {{Form::label('product_type', 'Product Type* ',['class'=>'control-label'])}}
                    {{ Form::select('product_type', $product_types,$category->type_id,['style'=>'width:100%','class'
                    =>'select2
                    form-control','placeholder'=>'--Select--','required'=>'required'])
                    }}
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6">


                <div class="form-group">
                    {{Form::label('category', 'Category name (Comma separated if multiple)*')}}
                    {{Form::text('category', $category->category_name,['class'=>'form-control',
                    'placeholder'=>'Enter Category'])}}
                </div>

            </div>

            <div class="col-md-6">


                <div class="form-group">
                    {{Form::label('active', 'Active* ',['class'=>'control-label'])}}
                    {{ Form::select('active',
                    ['1'=>'Active','2'=>'In-Active'],$category->active,['style'=>'width:100%','class'
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
       
        });
    
    </script>
    @stop