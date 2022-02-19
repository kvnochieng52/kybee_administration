{!!
Form::open(['action'=>['Admin\\UserController@update',$user->id],'method'=>'POST','class'=>'form
user_form','enctype'=>'multipart/form-data'])
!!}
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Security & Password</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12">
                    {{Form::label('full_names', 'Full Names* ')}}
                    <div class="form-group">
                        {{Form::text('full_names', $user->user_full_names,['class'=>'form-control', 'placeholder'=>'User
                        Full Names',
                        'required'=>'required'])}}
                    </div>
                </div>


            </div>

            <div class="row">

                <div class="col-md-4">
                    {{Form::label('email', 'Email')}}
                    <div class="form-group">
                        {{Form::email('email', $user->email,['class'=>'form-control', 'placeholder'=>'Enter The user
                        Email'])}}
                    </div>
                </div>

                <div class="col-md-4">
                    {{Form::label('password', 'Password')}}
                    <div class="form-group">
                        {{Form::password('password',['class'=>'form-control',
                        'placeholder'=>'Enter a strong Password'])}}
                    </div>
                </div>

                <div class="col-md-4">
                    {{Form::label('telephone', 'Telephone* ')}}
                    <div class="form-group">
                        {{Form::text('telephone', $user->telephone,['class'=>'form-control', 'placeholder'=>'User
                        Telephpone', 'required'=>'required'])}}
                    </div>
                </div>


            </div>


            <div class="row">

                <div class="col-md-4">

                    {{Form::label('role', 'Role')}}

                    <div class="form-group">
                        {{ Form::select('role', $roles,$user->role, ['class' =>
                        'form-control','placeholder'=>'--None--','required'=>'required']) }}
                    </div>

                </div>


                <div class="col-md-4">

                    {{Form::label('role', 'Active')}}

                    <div class="form-group">
                        {{ Form::select('is_active', ['in Active', 'Active'],$user->is_active, ['class' =>
                        'form-control','placeholder'=>'--None--','required'=>'required']) }}
                    </div>

                </div>
            </div>


            <hr />

            <h5>Permissions</h5>

            @foreach($perm_groups as $group)
            <p style="text-transform: uppercase; margin-bottom:5px"><strong>{{$group->group_name}}</strong></p>

            <div class="row" style="padding-bottom:15px">
                @foreach ($group->permissions as $permission)

                <div class="col-md-2">

                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="permissions[]"
                            id="{{$permission->id}}" value="{{$permission->id}}"
                            @if(in_array($permission->id,$user_permissions)) checked @endif
                        @if($user_role!=0) disabled @endif
                        >
                        <label for="{{$permission->id}}" class="custom-control-label"
                            style="font-weight: normal; font-size:13px">{{$permission->name}}
                        </label>
                    </div>
                </div>
                @endforeach
            </div>

            @endforeach


            <hr />



            <button type="submit" class="btn btn-primary btn-flat">UPDATE DETAILS</button>




        </div>
    </div>

</div>
<input type="hidden" name="section" value="security">
{{Form::hidden('_method','PUT')}} {!! Form::close() !!}
{!! Form::close() !!}