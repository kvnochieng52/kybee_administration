@extends('adminlte::page')
@section('title', 'Dashboard')

{{-- @section('content_header')
<h1>Dashboard</h1>
@stop --}}

@section('content')
<div class="row">

    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">CPU Traffic</span>
                <span class="info-box-number">
                    10
                    <small>%</small>
                </span>
            </div>

        </div>
    </div>
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">CPU Traffic</span>
                <span class="info-box-number">
                    10
                    <small>%</small>
                </span>
            </div>

        </div>
    </div>

    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">CPU Traffic</span>
                <span class="info-box-number">
                    10
                    <small>%</small>
                </span>
            </div>

        </div>
    </div>
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">CPU Traffic</span>
                <span class="info-box-number">
                    10
                    <small>%</small>
                </span>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Latest Products</h3>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped display nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Serial</th>
                                <th>Product Type</th>
                                <th>Category</th>
                                <th>Model</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>1</td>
                                <td>1B0461Z0068JBDYETS70016</td>
                                <td>Fridge</td>
                                <td>Frost Free</td>
                                <td>RT599N4ASU</td>
                                <td>
                                    <a href="/product/141" title="view Details"
                                        class="btn btn-xs btn-secondary"><strong> <i class="fas fa-search"></i></strong>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>340C05990030C101200089</td>
                                <td>Microwave</td>
                                <td>H36MOMMI</td>
                                <td>H36MOMMI</td>
                                <td>
                                    <a href="/product/140" title="view Details"
                                        class="btn btn-xs btn-secondary"><strong> <i class="fas fa-search"></i></strong>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>3TE32F20232101C28A30681</td>
                                <td>Television</td>
                                <td>Digital</td>
                                <td>32A5200FS</td>
                                <td>
                                    <a href="/product/139" title="view Details"
                                        class="btn btn-xs btn-secondary"><strong> <i class="fas fa-search"></i></strong>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>4</td>
                                <td>EB05179470218126110211</td>
                                <td>Microwave</td>
                                <td>H20MOMMI</td>
                                <td>H20MOMMI</td>
                                <td>
                                    <a href="/product/138" title="view Details"
                                        class="btn btn-xs btn-secondary"><strong> <i class="fas fa-search"></i></strong>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>5</td>
                                <td>3TE55F2025ED01C1N260150</td>
                                <td>Television</td>
                                <td>Smart</td>
                                <td>55A7100FS</td>
                                <td>
                                    <a href="/product/137" title="view Details"
                                        class="btn btn-xs btn-secondary"><strong> <i class="fas fa-search"></i></strong>
                                    </a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>

            <div class="card-footer">


            </div>
        </div>
    </div>

</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

<script>

</script>
@stop