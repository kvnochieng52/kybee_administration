@extends('adminlte::page')
@section('title', 'Product Types')

@section('content')
@include('notices')

<div class="card card-default color-palette-box">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-box-open"></i>
            Product Models <a href="product_models/create" class="btn btn-secondary btn-sm"><i class="fas fa-plus"></i>
                Add
                New</a>
        </h3>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table id="" class="table table-bordered table-striped display nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Type Name</th>
                        <th>Category Name</th>
                        <th>Model Name</th>
                        <th>Active</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($product_models as $key=>$model)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$model->product_type_name}}</td>
                        <td>{{$model->category_name}}</td>
                        <td>{{$model->product_model_name}}</td>
                        <td>
                            <span class="badge badge-{{$model->active==1 ? 'success' : 'secondary'}}">
                                {{$model->active==1 ? 'Active' : 'In-Active'}}
                            </span>
                        </td>
                        <td>

                            {!!
                            Form::open(['action'=>['ProductModelController@destroy',$model->id],'method'=>'POST','class'=>'floatit','enctype'=>'multipart/form-data'])
                            !!}


                            <a href="/product_models/{{$model->id}}/edit" title="Edit Details"
                                class="btn btn-xs btn-secondary"><strong> <i class="fas fa-edit"></i></strong> </a>

                            <button type="submit" class="btn btn-secondary btn-xs"
                                onClick="return confirm('Are you sure you want to delete this Product?');"> <strong>
                                    <strong> <i class="fas fa-trash"></i></strong></button>

                            {{Form::hidden('_method','DELETE')}}
                            {!! Form::close() !!}
                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{-- {{ $product_types->links() }} --}}

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