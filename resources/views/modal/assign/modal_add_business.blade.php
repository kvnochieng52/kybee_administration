<div class="modal fade" id="modal-add-business">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">New Business</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!!
                Form::open(['action'=>'BusinessController@store','method'=>'POST','class'=>'form new_business',
                'enctype'=>'multipart/form-data'])
                !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    {{Form::label('business_name', 'Business Name*')}}
                                    {{Form::text('business_name', null,['class'=>'form-control',
                                    'placeholder'=>'','required'=>'required'])}}
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    {{Form::label('contact_person', 'Contact Person* ')}}
                                    {{Form::text('contact_person', null,['class'=>'form-control',
                                    'placeholder'=>'','required'=>'required'])}}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    {{Form::label('email', 'Email*')}}
                                    {{Form::email('email', null,['class'=>'form-control',
                                    'placeholder'=>'','required'=>'required'])}}
                                </div>
                            </div>
                            <div class="col-md-6">



                                <div class="form-group">

                                    <input type="hidden" name="full_number">
                                    {{Form::label('telephone', 'Telephone* ')}}
                                    <br />
                                    {{Form::text('telephone', null,['class'=>'form-control',
                                    'placeholder'=>'','required'=>'required', 'style'=>'width:100%',
                                    'required'=>true])}}

                                </div>
                            </div>
                        </div>

                        <div class="row">


                            <div class="col-md-6">

                                <div class="form-group">
                                    {{Form::label('district', 'District*',['class'=>'control-label'])}}
                                    {{ Form::select('district', $districts,null,
                                    ['style'=>'width:100%','class' =>
                                    'select2
                                    form-control','placeholder'=>'--Specify--','required'=>true]) }}
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    {{Form::label('type', 'Type* ',['class'=>'control-label'])}}
                                    {{ Form::select('type', $roles,null,
                                    ['style'=>'width:100%','class' =>
                                    'select2
                                    form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                                </div>

                            </div>

                            {{-- <div class="col-md-6">

                                <div class="form-group">
                                    {{Form::label('town', 'Town ',['class'=>'control-label'])}}
                                    {{ Form::select('town', $towns,null,
                                    ['style'=>'width:100%','class' =>
                                    'select2
                                    form-control','placeholder'=>'--Specify--']) }}
                                </div>

                            </div> --}}

                        </div>




                        <div class="row">


                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('address', 'Address(optional)')}}
                                    {{Form::textarea('address', null,['class'=>'form-control',
                                    'placeholder'=>'','style'=>'height:70px'])}}
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary biz_submit">Submit</button>
            </div>

            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>