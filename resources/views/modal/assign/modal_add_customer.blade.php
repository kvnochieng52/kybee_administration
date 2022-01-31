<div class="modal fade" id="modal-add-customer">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">New Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!!
                Form::open(['action'=>'CustomerController@store','method'=>'POST','class'=>'form new_customer',
                'enctype'=>'multipart/form-data'])
                !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    {{Form::label('first_name', 'First Name*')}}
                                    {{Form::text('first_name', null,['class'=>'form-control',
                                    'placeholder'=>'Customer Last Name','required'=>'required'])}}
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    {{Form::label('last_name', 'Last Name* ')}}
                                    {{Form::text('last_name', null,['class'=>'form-control',
                                    'placeholder'=>'Customer Last Name','required'=>'required'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="full_number">
                                <div class="form-group">

                                    {{Form::label('primary_telephone', 'Primary Telephone*')}}
                                    {{Form::text('primary_telephone',
                                    null,['class'=>'form-control','required'=>'required','placeholder'=>'Format:256712345678'])}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input type="hidden" name="full_number_secondary">
                                <div class="form-group">
                                    {{Form::label('secondary_telephone', 'Secondary Telephone')}}
                                    {{Form::text('secondary_telephone',
                                    null,['class'=>'form-control','placeholder'=>'Format:256712345678'])}}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    {{Form::label('email', 'Email')}}
                                    {{Form::email('email', null,['class'=>'form-control',
                                    'placeholder'=>'Customers Email'])}}
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    {{Form::label('district', 'District ',['class'=>'control-label'])}}
                                    {{ Form::select('district', $districts,null,
                                    ['style'=>'width:100%','class' =>
                                    'select2
                                    form-control','placeholder'=>'--Specify--']) }}
                                </div>

                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{Form::label('address', 'Address')}}
                                    {{Form::textarea('address', null,['class'=>'form-control',
                                    'placeholder'=>'','style'=>'height:50px'])}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary customer_submit">Submit</button>
            </div>

            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>