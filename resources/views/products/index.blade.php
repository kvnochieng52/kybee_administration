@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content')
@include('notices')

<div class="card card-default color-palette-box">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-box-open"></i>
            Products
        </h3>
    </div>
    <div class="card-body">
        {!!
        Form::open(['action'=>'ProductController@search','method'=>'GET','class'=>'form user_form',
        'enctype'=>'multipart/form-data'])
        !!}
        <div class="row">
            <div class="col-md-4">
                {{Form::label('search_by', 'Search Records By* ',['class'=>'control-label'])}}
                <div class="form-group">
                    {{ Form::select('search_by',
                    [
                    'serial' => 'Serial Number',
                    'product_type' => 'Product Type',
                    'category' => 'Category',
                    'model' => 'Model',
                    ],
                    request()->get('search_by'),
                    ['class' => 'form-control','placeholder'=>'--Specify--']) }}
                </div>
            </div>

            <div class="col-md-4">
                {{Form::label('search_value', 'Enter Search Value*')}}
                <div class="form-group">
                    {{Form::text('search_value', request()->get('search_value'),['class'=>'form-control',
                    'placeholder'=>'Search Value'])}}
                </div>
            </div>

            <div class="col-md-4">

                <div class="form-group" style="padding-top:30px">
                    <button class="btn btn-secondary btn-block"><strong> SEARCH RECORDS </strong></button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="table-responsive">
            <table id="" class="table table-bordered table-striped display nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Serial</th>
                        <th>Product Type</th>
                        <th>Category</th>
                        <th>Model</th>
                        <th>Issued To</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key=>$product)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$product->product_serial}}</td>
                        <td>{{$product->product_type_name}}</td>
                        <td>{{$product->category_name}}</td>
                        <td>{{$product->product_model_name}}</td>
                        <td>
                            @if($product->assign_type_name=='Business')
                            {{$product->business_name}} ({{$product->assign_type_name}})
                            @else
                            {{$product->first_name}}
                            {{$product->last_name}} ({{$product->assign_type_name}})
                            @endif
                        </td>
                        <td>
                            {!!
                            Form::open(['action'=>['ProductController@destroy',$product->id],'method'=>'POST','class'=>'floatit','enctype'=>'multipart/form-data'])
                            !!}


                            @can('View Products')
                            <a href="/product/{{$product->id}}" title="view Details"
                                class="btn btn-xs btn-secondary"><strong> <i class="fas fa-search"></i></strong> </a>
                            @endcan
                            @can('Edit Product')
                            <a href="/product/{{$product->id}}/edit" title="Edit Details"
                                class="btn btn-xs btn-secondary"><strong> <i class="fas fa-edit"></i></strong> </a>
                            @endcan

                            @can('Delete Product')
                            <button type="submit" class="btn btn-secondary btn-xs"
                                onClick="return confirm('Are you sure you want to delete this Product?');"> <strong>
                                    <strong> <i class="fas fa-trash"></i></strong></button>
                            @endcan

                            {{Form::hidden('_method','DELETE')}}
                            {!! Form::close() !!}





                        </td>
                    </tr>

                    @endforeach


                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $products->links() }}

        </div>
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