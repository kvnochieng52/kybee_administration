@extends('adminlte::page')
@section('title', 'Product Types')

@section('content')
@include('notices')

<div class="card card-default color-palette-box">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-box-open"></i>
            Product Types <a href="product_type/create" class="btn btn-secondary btn-sm"><i class="fas fa-plus"></i> Add
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
                        <th>Visible</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product_types as $key=>$type)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$type->product_type_name}}</td>
                        <td><span class="badge badge-{{$type->active==1 ? 'success' : 'secondary'}}">
                                {{$type->active==1 ? 'Active' : 'In-Active'}}
                            </span></td>
                        <td>

                            {!!
                            Form::open(['action'=>['ProductTypeController@destroy',$type->id],'method'=>'POST','class'=>'floatit','enctype'=>'multipart/form-data'])
                            !!}


                            <a href="/product_type/{{$type->id}}/edit" title="Edit Details"
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
            {{ $product_types->links() }}

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