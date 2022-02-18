@extends('adminlte::page')
@section('title', 'Loans pending paymants')


@section('content')

@include('notices')

<div class="card card-default color-palette-box">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-cash"></i>
            {{$title}}
        </h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped display nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Telephone</th>
                                <th>Loan Amount</th>
                                <th>Disbursed</th>
                                <th>Intrest</th>
                                <th>Application Date</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loans as $key=>$loan)
                            <tr>

                                <td>{{$key+1}}</td>
                                <td>
                                    <a href="/loans/{{$loan->id}}/edit" title="Show Details">
                                        <b>{{$loan->first_name}} {{$loan->middle_name}} {{$loan->last_name}}</b>
                                    </a>
                                </td>
                                <td>{{$loan->telephone}}</td>
                                <td>Ksh {{$loan->total_amount}}</td>
                                <td>Ksh {{$loan->disbursed}}</td>
                                <td>Ksh {{$loan->interest+$loan->commission}}</td>
                                <td> {{\Carbon\Carbon::parse($loan->application_date)->format("d-F-Y")}}</td>
                                <td> {{\Carbon\Carbon::parse($loan->due_date)->format("d-F-Y")}}</td>
                                <td>

                                    <a href="/loans/{{$loan->id}}/edit" title="Show Details">


                                        @if($loan->repayment_status_id==$REPAYMENT_CLOSED)
                                        <span class="badge badge-success">PAID </span>

                                        @else


                                        <?php $due_date= \Carbon\Carbon::parse($loan->due_date) ?>


                                        @if(\Carbon\Carbon::now()->isSameDay($due_date))
                                        <span class="badge badge-warning">DUE </span>

                                        @elseif($due_date->isPast())

                                        <span class="badge badge-danger">OVERDUE </span>

                                        @else

                                        <span class="badge badge-success">NORMAL </span>
                                        @endif

                                        @endif


                                    </a>
                                </td>
                                <td>

                                    <a href="/loans/{{$loan->id}}" title="Show Details"
                                        class="btn btn-xs btn-secondary"><strong> <i class="fas fa-search"></i></strong>
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
            {{ $loans->links() }}

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