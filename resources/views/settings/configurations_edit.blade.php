@extends('adminlte::page')
@section('title', 'Settings::Configurations')


@section('content')

@include('notices')

<div class="card card-default color-palette-box">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-cash"></i>
            Edit Configuration
        </h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                {!!
                Form::open(['action'=>'SettingController@update','method'=>'POST','class'=>'form
                user_form',
                'enctype'=>'multipart/form-data'])
                !!}
                <div class="row">
                    <div class="col-md-12">
                        {{Form::label('setting_name', 'Setting Name*')}}
                        <div class="form-group">
                            {{Form::text('setting_name', $setting->setting_name,['class'=>'form-control',
                            'placeholder'=>'Enter Setting Name','required'=>true])}}
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        {{Form::label('setting_value', 'Setting Value*')}}
                        <div class="form-group">
                            {{Form::textarea('setting_value', $setting->setting_value,['class'=>'form-control',
                            'placeholder'=>'Enter Setting Value','required'=>true])}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        {{Form::label('active', 'Active')}}

                        <div class="form-group">
                            {{ Form::select('active', ['1'=>'Active','0'=>'In-active'],$setting->active, ['class' =>
                            'form-control','placeholder'=>'--None--','required'=>true]) }}
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-flat">UPDATE DETAILS</button>
                <input type="hidden" name="setting_id" value="{{$setting->id}}">

                {!! Form::close() !!}
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