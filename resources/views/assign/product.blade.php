@extends('adminlte::page')
@section('title', 'Assign Product')

@section('content')
@include('notices')

{!!
Form::open(['action'=>'AssignController@process','method'=>'POST','class'=>'form user_form',
'enctype'=>'multipart/form-data'])
!!}
<div class="card card-default color-palette-box">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-box-open"></i>
            Assign Product
        </h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-12">
                        <p>Select Serial Source:&nbsp;

                            <label> <input type="radio" id="enter_serial" name="source" class="source"
                                    value="enter_serial" checked>
                                Enter Serial</label>
                            &nbsp;
                            &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                            <label> <input type="radio" id="upload_csv" name="source" class="source" value="upload_csv">
                                Upload
                                CSV</label>
                        </p>


                    </div>

                    <div class="col-md-12">

                        <div class="source_wrap enter_serial">
                            <div class="form-group">
                                {{Form::label('serial', 'Enter Serial Number(Comma separated if multiple)* ')}}
                                {{Form::textarea('serial', null,['class'=>'form-control',
                                'placeholder'=>'Enter the serial no','style'=>'height:100px'])}}
                            </div>


                        </div>

                        <div class="source_wrap upload_csv" style="display: none">
                            <div class="form-group">
                                <label for="exampleInputFile">Upload CSV file with Serials(Allowed format: CSV, Comma
                                    delimited)</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input csv_upload" id="csv_upload"
                                            name="csv_upload">
                                        <label class="custom-file-label" for="csv_upload"> Select CSV file with
                                            serials
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>





                    {{-- <div class="col-md-4">

                        <div class="form-group">
                            {{Form::label('serial', 'Serial Number* ')}}
                            {{Form::text('serial', null,['class'=>'form-control',
                            'placeholder'=>'Enter the serial no'])}}

                            <input type="hidden" id="selected_serials_field" name="selected_serials_field" value=""
                                class="selected_serials_field">
                        </div>
                    </div>
                    <div class="col-md-2" style="padding-top: 30px">
                        <button class="btn btn-link  add_serial"><i class="fa fa-fw fa-plus"></i> Add Serial</button>
                    </div> --}}

                    <div class="col-md-12">
                        <p>Assign To:&nbsp;

                            <label> <input type="radio" id="business" name="assign_to" class="assign_to"
                                    value="business" checked>
                                Business</label>
                            &nbsp;
                            &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                            <label> <input type="radio" id="customer" name="assign_to" class="assign_to"
                                    value="customer">
                                Customer</label>
                        </p>


                    </div>

                    <div class="col-md-12">

                        <div class="ajax_message" style="color: green; font-weight:bold">

                        </div>
                        <div class="assign_search_wrap business">




                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        {{Form::label('business_select', 'Select Business*
                                        ',['class'=>'control-label'])}}
                                        {{ Form::select(
                                        'business_select',
                                        $businesses,
                                        null,
                                        ['style'=>'width:100%',
                                        'class' =>'business_select form-control select2',
                                        'placeholder'=>'--Specify--']) }}
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <a href="#modal-add-business" data-toggle="modal"
                                        data-target="#modal-add-business"><i class="fas fa-plus"></i> New Business</a>
                                </div>
                            </div>

                            {{-- <div class="form-group">
                                {{Form::label('search_business', 'Search Business by business No. or Name*
                                ')}}
                                <div class="row">
                                    <div class="col-md-8">
                                        {{Form::text('search_business', null,['class'=>'form-control',
                                        'placeholder'=>'Search the Business'])}}
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-sm btn-default search_business"><b>SEARCH
                                                BUSINESS</b></button>
                                    </div>
                                </div>
                            </div>

                            <div class="business_list_show"></div> --}}
                        </div>

                        <div class="assign_search_wrap customer" style="display: none">


                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        {{Form::label('customer_select', 'Select Customer*
                                        ',['class'=>'control-label'])}}
                                        {{ Form::select(
                                        'customer_select',
                                        $customers,
                                        null,
                                        ['style'=>'width:100%',
                                        'class' =>'customer_select form-control select2',
                                        'placeholder'=>'--Specify--']) }}
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <a href="#modal-add-customer" data-toggle="modal"
                                        data-target="#modal-add-customer"><i class="fas fa-plus"></i> New
                                        Customer</a>
                                </div>
                            </div>
                            {{-- <div class="form-group">
                                {{Form::label('search_customer', 'Search Customer by Name or Tel*
                                ')}}
                                <div class="row">
                                    <div class="col-md-8">
                                        {{Form::text('search_customer', null,['class'=>'form-control',
                                        'placeholder'=>'Search the Customer'])}}
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-sm btn-default search_customer"><b>SEARCH
                                                CUSTOMER</b></button>
                                    </div>
                                </div>
                            </div>


                            <div class="customer_list_show"></div> --}}
                        </div>
                    </div>
                </div>



                <div class="row">

                    <div class="col-md-12">
                        <div class="selected_serials">
                            <ul></ul>
                        </div>
                    </div>
                </div>



            </div>
        </div>

    </div>

    <div class="card-footer">
        <div class="row">

            <div class="col-md-10">
                <button type="submit" class="btn btn-secondary"><strong> ASSIGN</strong></button>

            </div>
        </div>
    </div>
</div>


{!! Form::close() !!}

@include('modal/assign/modal_add_business')
@include('modal/assign/modal_add_customer')

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<style>
    .selected_serials ul {
        list-style-type: none;
        padding-left: 0px
    }

    .selected_serials ul li {
        display: inline;
        margin-right: 10px;
    }

    .business_list_show th,
    .business_list_show td {
        padding: 3px !important
    }

    .customer_list_show th,
    .customer_list_show td {
        padding: 3px !important
    }
</style>
@stop

@section('js')

<script>
    $(function () {
      
        $('.select2').select2()
    
        $(".search_business").click(function(e) {

            var search_val=$('#search_business').val();
            if(search_val.length === 0){
                alert('Please Enter the Search Value')
                
            }else{
               $(this).html('SEARCHING...PLEASE WAIT')
                $.ajax({
                    type:'GET',
                    url:'/assign/search_business',
                    data:{'search_val':$('#search_business').val()},
                    success:function(data){
                        if(data.length===0){
                            $('.business_list_show').html('<span style="color:red"><b>No Records Found mathcing youy query</b></span>')
                        }else{

                            var html_table='<table class="table table-striped table-bordered">';
                            html_table+='<tr>';
                            html_table+='<th>ID</th>';
                            html_table+='<th>Business Name</th>';
                            html_table+='<th>Type</th>';
                            html_table+='<th>Contact Person</th>';
                            html_table+='<th>Telephone</th>';
                            html_table+='<th>District</th>';
                            html_table+='<th>Address</th>';
                            html_table+='<th></th>';
                            html_table+='</tr>';
                           
                            $.each(data, function(index, element) {
                                html_table+='<tr>';
                                html_table+='<td>'+element.id+'</td>';
                                html_table+='<td>'+element.business_name+'</td>';
                                html_table+='<td>'+element.type_name+'</td>';
                                html_table+='<td>'+element.contact_person+'</td>';
                                html_table+='<td>'+element.telephone+'</td>';
                                html_table+='<td>'+element.district_name+'</td>';
                                html_table+='<td>'+element.address+'</td>';
                                html_table+='<td><label><input type="radio" name="business_select" value="'+element.id+'"'+'> Select</label></td>';
                                html_table+='</tr>';
                                                    
                            });


                            html_table+='</table>';

                            $('.business_list_show').html(html_table);

                           
                        }

                        $(".search_business").html('<b>SEARCH BUSINESS</b>')

                    },
                    error:function(e){}
                });
            }

            
            e.preventDefault();
           
        });

        $(".search_customer").click(function(e) {
            var search_val=$('#search_customer').val();
            if(search_val.length === 0){
                alert('Please Enter the Search Value')
            }else{
               $(this).html('SEARCHING...PLEASE WAIT')
                $.ajax({
                    type:'GET',
                    url:'/assign/search_customer',
                    data:{'search_val':$('#search_customer').val()},
                    success:function(data){
                        if(data.length===0){
                            $('.customer_list_show').html('<span style="color:red"><b>No Records Found mathcing youy query</b></span>')
                        }else{

                            var html_table='<table class="table table-striped table-bordered">';
                            html_table+='<tr>';
                            html_table+='<th>Full Name</th>';
                            html_table+='<th>Primary Telephone</th>';
                            html_table+='<th>Secondary Telephone</th>';
                            html_table+='<th>Email</th>';
                            html_table+='<th>District</th>';
                            html_table+='<th>Address</th>';
                            html_table+='<th></th>';
                            html_table+='</tr>';
                           
                            $.each(data, function(index, element) {
                                html_table+='<tr>';
                                html_table+='<td>'+element.first_name+ ' '+element.last_name+'</td>';
                                html_table+='<td>'+element.primary_telephone+'</td>';
                                html_table+='<td>'+element.secondary_telephone+'</td>';
                                html_table+='<td>'+element.email+'</td>';
                                html_table+='<td>'+element.district_name+'</td>';
                                html_table+='<td>'+element.address+'</td>';
                                html_table+='<td><label><input type="radio" name="customer_select" value="'+element.id+'"'+'> Select</label></td>';
                                html_table+='</tr>';
                                                    
                            });


                            html_table+='</table>';

                            $('.customer_list_show').html(html_table);


                        }
                        $(".search_customer").html('<b>SEARCH CUSTOMER</b>')

                    },
                    error:function(e){}
                });
            }

            e.preventDefault();
        });

        
        $('.source').change(function(){
            var selected_option=$(this).val();
            $('.source_wrap').hide();
            $('.'+selected_option).show();  
        });


          
        $('.assign_to').change(function(){
            var selected_option=$(this).val();
            $('.assign_search_wrap').hide();
            $('.'+selected_option).show();  
        });


        
        $(".new_business").submit(function(e) {


            $('.biz_submit').text("Submitting... Please wait");
            e.preventDefault();
            $.ajax({
                    url: '/assign/new_business',
                    type: 'get',
                    data: $(".new_business").serialize(),
                    success: function(data) {
                      var $dropdown = $("#business_select");
                      $($dropdown)[0].options.length = 0;
                      $dropdown.append($("<option />").val(data.business_id).text(data.business_name));
                      $('#modal-add-business').modal('hide');
                      $('.biz_submit').text("Submit");
                      $('.ajax_message').html("Business successfully added and selected");
                     
                    }
            });

        });


           
        $(".new_customer").submit(function(e) {


            $('.customer_submit').text("Submitting... Please wait");
            e.preventDefault();
            $.ajax({
                    url: '/assign/new_customer',
                    type: 'get',
                    data: $(".new_customer").serialize(),
                    success: function(data) {
                      var $dropdown = $("#customer_select");
                      $($dropdown)[0].options.length = 0;
                      $dropdown.append($("<option />").val(data.customer_id).text(data.customer_name));
                      $('#modal-add-customer').modal('hide');
                      $('.biz_submit').text("Submit");
                      $('.ajax_message').html("customer successfully added and selected");
                     
                    }
            });

        });


        // $(".business_selector").select2({
        // ajax: {
        //     url: "/business/business_select",
        //     type:'GET',
        //     dataType: 'json',
        //     delay: 250,
        //     data: function (params) {
        //         console.log(params);
        //     return {
        //         q: params.term, // search term
        //         page: params.page
        //     };
        //     },
        //     processResults: function (data, params) {


        //     params.page = params.page || 1;
        //     var retVal = [];
        //     $.each(data, function(index, element) {
        //             var lineObj = {
        //                 id: element.id,
        //                 text: element.text
        //             }
        //         retVal.push(lineObj);
        //         });


        //     return {
        //         results: retVal,
        //         pagination: {
        //         more: (params.page * 30) < data.total_count
        //         }
        //     };
        //     },
        //     cache: true
        // },
        // placeholder: 'Select Business...',
        // escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        // minimumInputLength: 3,
        // templateResult: formatRepo,
        // templateSelection: formatRepoSelection
        // });


        // function formatRepo (repo) {
        //     if (repo.loading) {
        //         return repo.text;
        //     }
        //     var markup =repo.text;
        //     return markup;
        // }

        // function formatRepoSelection (repo) {
        // return repo.text ;
        // }
           
    })
</script>
@stop