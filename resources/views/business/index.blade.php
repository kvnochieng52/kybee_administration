@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content')
@include('notices')
<div class="card card-default color-palette-box">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-box-open"></i>
            Businesses
        </h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped display nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Business Name</th>
                        <th>Type</th>
                        <th>Contact Person </th>
                        <th>Email</th>
                        <th>Telephone</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($businesses as $key=>$business)
                    <tr>

                        <td>{{$key+1}}</td>
                        <td>{{$business->business_name}}</td>
                        <td>{{$business->type_name}}</td>
                        <td>{{$business->contact_person}}</td>
                        <td>{{$business->email}}</td>
                        <td>{{$business->telephone}}</td>
                        <td>
                            {!!
                            Form::open(['action'=>['BusinessController@destroy',$business->id],'method'=>'POST','class'=>'floatit','enctype'=>'multipart/form-data'])
                            !!}

                            @can('Edit business')
                            <a href="/businesses/{{$business->id}}/edit" title="Edit Details"
                                class="btn btn-xs btn-secondary"><strong> <i class="fas fa-edit"></i></strong> </a>
                            @endcan
                            @can('Delete business')
                            <button type="submit" class="btn btn-secondary btn-xs"
                                onClick="return confirm('Are you sure you want to delete this Business?');"> <strong>
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