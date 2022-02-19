{!!
Form::open(['action'=>['Admin\\UserController@update',$user->id],'method'=>'POST','class'=>'form
user_form','enctype'=>'multipart/form-data'])
!!}
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Loan Limit</h3>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-4">
                {{Form::label('loan_limit', 'Seelect Loan Limit')}}

                <div class="form-group">
                    {{ Form::select('loan_limit', $loan_limits,$current_user_limit, ['class' =>
                    'form-control','placeholder'=>'--None--']) }}
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="section" value="loan_limit">
<button type="submit" class="btn btn-primary btn-flat">UPDATE DETAILS</button>

{{Form::hidden('_method','PUT')}}
{!! Form::close() !!}