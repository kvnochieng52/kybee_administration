@extends('adminlte::page')

@section('title', 'All Users')

{{-- @section('content_header')
<h1>Candidates</h1>
@stop --}}

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Users</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Names</th>
                        <th>Email</th>
                        <th>Telephone</th>
                        <th>Role</th>
                        <th>Active</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($users as $key=>$user)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td><a href="{{url('/')}}/admin/users/{{$user->id}}/edit"><b>{{$user->user_full_names}}</b></a>
                        </td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->telephone}}</td>
                        <td>{{$user->role}}</td>
                        <td><a href="{{url('/')}}/admin/users/{{$user->id}}/edit">@if($user->is_active==1)<span
                                    class="badge badge-success">Active</span>@else<span
                                    class="badge badge-secondary">Inactive</span> @endif</a></td>
                        <td>


                            {!!
                            Form::open(['action'=>['Admin\\UserController@destroy',$user->id],'method'=>'POST','class'=>'floatit','enctype'=>'multipart/form-data'])
                            !!}
                            {{-- @can('Edit User') --}}
                            <a href="{{url('/')}}/admin/users/{{$user->id}}/edit" title="Edit Details"
                                class="btn btn-xs btn-info"><strong> <i class="fas fa-edit"></i></strong> </a>
                            {{-- @endcan --}}
                            {{Form::hidden('_method','DELETE')}}
                            {{-- @can('Delete User') --}}
                            <button type="submit" class="btn btn-secondary btn-xs btn-flat"
                                onClick="return confirm('Are you sure you want to delete this User?');"> <strong>
                                    <strong> <i class="fas fa-trash"></i></strong></button>
                            {{-- @endcan --}}



                            {!! Form::close() !!}


                        </td>

                    </tr>

                    @endforeach
                </tbody>

            </table>

        </div>

    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": false,
            "autoWidth": false,
            "ordering": false,
        });
   
    });
</script>
@stop