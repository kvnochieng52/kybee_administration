@extends('adminlte::page')
@section('title', 'Settings::Terms and Conditions')


@section('content')

@include('notices')


<div class="card card-default color-palette-box">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-box-open"></i>
            Terms & Conditions
        </h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                {!!html_entity_decode($terms)!!}
            </div>
        </div>
    </div>


</div>

{!! Form::close() !!}

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link href="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet">
@stop

@section('js')
<script src="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script>
    $(function () {

         $('.terms_textbox').wysihtml5({
            toolbar: {
                "font-styles": true,
                "emphasis": true, 
                "lists": true, 
                "html": false, 
                "link": false, 
                "image": false,
                "color": false, 
                "blockquote": false, 
            }
        })

    })

</script>
@stop