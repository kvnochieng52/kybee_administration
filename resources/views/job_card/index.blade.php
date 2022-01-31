@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content')
@include('notices')


<div class="card card-default color-palette-box">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-box-open"></i>
            Job Cards
        </h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped display nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Job Card No</th>
                        <th>Serial</th>
                        <th>Product Type </th>
                        <th>Category</th>
                        <th>Model</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($job_cards as $key=>$job_card)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td># {{\Carbon\Carbon::parse($job_card->created_at)->format("Y/m/d")}}/{{$job_card->id}}</td>
                        <td>{{$job_card->product_serial}}</td>
                        <td>{{$job_card->product_type_name}}</td>
                        <td>{{$job_card->category_name}}</td>
                        <td>{{$job_card->product_model_name}}</td>
                        <td>{{\Carbon\Carbon::parse($job_card->date_brought)->format("d-m-Y")}}</td>
                        <td><span
                                class="badge badge-{{$job_card->color_code}}">{{$job_card->job_card_status_name}}</span>
                        </td>
                        <td>

                            {!!
                            Form::open(['action'=>['JobCardController@destroy',$job_card->id],'method'=>'POST','class'=>'floatit','enctype'=>'multipart/form-data'])
                            !!}
                            <a href="job_cards/{{$job_card->id}}" title="Show Details"
                                class="btn btn-xs btn-secondary"><strong> <i class="fas fa-search"></i></strong> </a>

                            <a href="job_cards/{{$job_card->id}}/edit" title="Edit Details"
                                class="btn btn-xs btn-secondary"><strong> <i class="fas fa-edit"></i></strong>
                            </a>
                            <button type="submit" class="btn btn-secondary btn-xs"
                                onClick="return confirm('Are you sure you want to delete this Job Card?');"> <strong>
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
    <script src="/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
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