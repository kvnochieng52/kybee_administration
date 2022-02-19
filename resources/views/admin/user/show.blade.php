@extends('adminlte::page')
@section('title', 'User Details')


@section('content')

@include('notices')

<div class="card card-primary card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-four-details-tab" data-toggle="pill"
                    href="#custom-tabs-four-details" role="tab" aria-controls="custom-tabs-four-details"
                    aria-selected="true"><strong><i class="fas fa-info-circle"></i>BASIC DETAILS</strong></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-phone_book-tab" data-toggle="pill"
                    href="#custom-tabs-four-phone_book" role="tab" aria-controls="custom-tabs-four-phone_book"
                    aria-selected="false"><i class="fas fa-mobile"></i>
                    PHONE BOOK</a>
            </li>


            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill"
                    href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages"
                    aria-selected="false"><i class="fas fa-envelope"></i> MESSAGES</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-loans-tab" data-toggle="pill" href="#custom-tabs-four-loans"
                    role="tab" aria-controls="custom-tabs-four-loans" aria-selected="false"><i
                        class="fas fa-money-bill"></i>
                    LOANS</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-four-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-four-details" role="tabpanel"
                aria-labelledby="custom-tabs-four-details-tab">
                @include('admin.user.show._basic_details')
            </div>

            <div class="tab-pane fade" id="custom-tabs-four-phone_book" role="tabpanel"
                aria-labelledby="custom-tabs-four-phone_book-tab">
                @include('admin.user.show._phone_book')
            </div>

            <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel"
                aria-labelledby="custom-tabs-four-messages-tab">
                @include('admin.user.show._messages')
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-loans" role="tabpanel"
                aria-labelledby="custom-tabs-four-loans-tab">
                @include('admin.user.show._loans')
            </div>

        </div>
    </div>

</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<style>
    .reduce_padding td,
    .reduce_padding th {
        padding: 3px !important;
    }

    .content {
        word-wrap: break-word;
        /*old browsers*/
        overflow-wrap: break-word;
    }

    .overflow-wrap-hack {
        max-width: 1px;
    }
</style>
@stop

@section('js')
<script>
    $(function () {

        $(".records").DataTable({
        "responsive": false,
        "autoWidth": false,
        "ordering": false,
        });

    })

</script>
@stop