<div class="modal fade" id="modal-add_document">
    <div class="modal-dialog modal-lg">
        {!!
        Form::open(['action'=>'DocumentController@store','method'=>'POST','class'=>'form user_form',
        'enctype'=>'multipart/form-data'])
        !!}
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ADD DOCUMENT</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{Form::label('document_type', 'Select Document Type* ',['class'=>'control-label'])}}
                            {{ Form::select('document_type', $document_types,null,
                            ['style'=>'width:100%','class' =>
                            'select2
                            form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::label('serial_no', 'Serial No* ')}}
                            {{Form::text('serial_no', null,['class'=>'form-control',
                            'placeholder'=>'','required'=>'required'])}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::label('issued_date', 'Issued Date* ')}}
                            {{Form::text('issued_date', null,['class'=>'form-control',
                            'placeholder'=>'','required'=>'required','autocomplete'=>'off'])}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::label('validity_period', 'Validity Period* ')}}
                            {{Form::number('validity_period', null,['class'=>'form-control',
                            'placeholder'=>'','required'=>'required'])}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::label('validity_type', 'Validity Type* ',['class'=>'control-label'])}}
                            {{ Form::select('validity_type', $validity_periods,null,
                            ['style'=>'width:100%','class' =>
                            'select2
                            form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <button type="submit" class="btn btn-secondary">SUBMIT</button>
            </div>
        </div>
        <!-- /.modal-content -->

        {!! Form::close() !!}
    </div>
    <!-- /.modal-dialog -->
</div>