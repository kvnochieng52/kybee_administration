@extends('adminlte::page')
@section('title', 'Settings::Configurations')


@section('content')

@include('notices')

<div class="card card-default color-palette-box">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-cash"></i>
            Loans
        </h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Configuration Name</th>
                                <th>Code</th>
                                <th>Value</th>
                                <th>Active</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($configurations as $key=>$configuration)
                            <tr>

                                <td>{{$key+1}}</td>

                                <td>
                                    <a href="/settings/{{$configuration->id}}/edit" title="Show Details">
                                        <b><i class="fas fa-cog"></i> {{$configuration->setting_name}}</b>
                                    </a>
                                </td>

                                <td>
                                    {{$configuration->code}}
                                </td>

                                <td>
                                    {{$configuration->setting_value}}
                                </td>

                                <td>

                                    <a href="/settings/{{$configuration->id}}/edit" title="Show Details">
                                        {{$configuration->active}}

                                    </a>
                                </td>


                                <td>

                                    <a href="/settings/{{$configuration->id}}/edit" title="Show Details"
                                        class="btn btn-xs btn-secondary"><strong> <i class="fas fa-edit"></i></strong>
                                    </a>
                                </td>


                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="card-footer">

        </div>
    </div>
</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script>
    // $(function () {

    //      $('.terms_textbox').wysihtml5({
    //         toolbar: {
    //             "font-styles": true,
    //             "emphasis": true, 
    //             "lists": true, 
    //             "html": false, 
    //             "link": false, 
    //             "image": false,
    //             "color": false, 
    //             "blockquote": false, 
    //         }
    //     })

    // })

</script>
@stop