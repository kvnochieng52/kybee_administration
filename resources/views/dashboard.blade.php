@extends('adminlte::page')
@section('title', 'Dashboard')

{{-- @section('content_header')
<h1>Dashboard</h1>
@stop --}}

@section('content')
<div class="row">

    <div class="col-md-3">
        <div class="info-box mb-3 bg-default">
            <span class="info-box-icon" style="color:#0e3192"><i class="fas fa-box-open"></i></span>

            <div class="info-box-content">
                <span class="info-box-text"> Total Products</span>
                <h5 class="info-box-number">{{$products_count}}</h5>


            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-md-3">
        <div class="info-box mb-3 bg-default">
            <span class="info-box-icon" style="color:#0e3192"><i class="fas fa-building"></i></span>

            <div class="info-box-content">
                <span class="info-box-text"> Total Business</span>
                <h5 class="info-box-number">{{$business_count}}</h5>


            </div>
            <!-- /.info-box-content -->
        </div>
    </div>

    @can('View Job Cards')

    <div class="col-md-3">
        <div class="info-box mb-3 bg-default">
            <span class="info-box-icon" style="color:#0e3192"><i class="fas fa-cog"></i></span>

            <div class="info-box-content">
                <span class="info-box-text"> Total Job Cards</span>
                <h5 class="info-box-number">{{$job_cards}}</h5>


            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    @endcan

    <div class="col-md-3">
        <div class="info-box mb-3 bg-default">
            <span class="info-box-icon" style="color:#0e3192"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text"> Total Customers</span>
                <h5 class="info-box-number">{{$customers_count}}</h5>


            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
</div>
@can('View Job Cards')

<div class="row">
    <div class="col-md-6">
        <div class="card card-default color-palette-box">
            <div class="card-header">
                <h3 class="card-title">Pending Job Cards</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th>Job Card No</th>
                            <th>Product Name</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($pending_job_cards as $job_card)

                        <tr>
                            <td>#{{\Carbon\Carbon::parse($job_card->created_at)->format("Y/m/d")}}/{{$job_card->id}}
                            </td>
                            <td>{{$job_card->product_type_name}} {{$job_card->category_name}}</td>
                            <td>{{\Carbon\Carbon::parse($job_card->date_brought)->format('d-M-Y')}}</td>
                            <td><span
                                    class="badge badge-{{$job_card->color_code}}">{{$job_card->job_card_status_name}}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            <div class="card-footer">
            </div>
        </div>
    </div>


    <div class="col-md-6">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Job Card Stats</h3>

            </div>
            <div class="card-body">
                <canvas id="donutChart"
                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>

            <div class="card-footer">
            </div>
            <!-- /.card-body -->
        </div>
    </div>

</div>
@endcan

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

                            @foreach($latest_products as $key=>$product)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$product->product_serial}}</td>
                                <td>{{$product->product_type_name}}</td>
                                <td>{{$product->category_name}}</td>
                                <td>{{$product->product_model_name}}</td>
                                <td>
                                    <a href="/product/{{$product->id}}" title="view Details"
                                        class="btn btn-xs btn-secondary"><strong> <i class="fas fa-search"></i></strong>
                                    </a>
                                </td>
                            </tr>

                            @endforeach
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
    $(function () {
        
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData = {
                labels: [
                    'Open Job Cards',
                    'In-Progress',
                    'Closed',
                    
                    
                ],
                datasets: [
                    {
                        data: [{{$open_job_cards}},{{$in_progress_job_cards}},{{$closed_job_cards}}],
                        backgroundColor: ['#dbdbdb', '#0e3192','#6c757d'],
                    }
                ]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: true,
                    position:'bottom'
                }
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var donutChart = new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })

            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
           // var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = donutData;
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
           
        })
</script>
@stop