@extends('user::dashboard.layout.master')
@section('content')
    <script>
        function getOrganization(val)
        {
            if(val=='0')
            {
                $("#organization").hide();
                $("#role").hide();

            }
            else{
                $("#organization").show();
                $("#role").show();
            }

        }

    </script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @include('common.flash')

                    <div class="card-header">{{ __('Edit User Information') }}</div>
                    <form method="POST" action="{{ route('user.edit',['id'=>$data->id]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name<span>*</span></label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$data->name}}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email Address<span>*</span></label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $data->email }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            @if(Auth::user()->type==0)

                                <div class="form-group row" id="type">
                                    <label for="organization" class="col-md-4 col-form-label text-md-right">User Type<span>*</span></label>

                                    <div class="col-md-6">

                                        <div>
                                            <div class="radio" style="float: left;">
                                                <input type="radio" name="type"  value="0" {{($data->type == 0) ? 'checked' : ''}} onclick="getOrganization(this.value)" required>
                                                <img src="{{asset('assets/img/superadmin.png')}}" class="thumbnail" style="height: 40px;">Super Admin
                                            </div>
                                            <div class="radio" style="float: right;">
                                                <input type="radio" name="type"  value="1" {{($data->type == 1) ? 'checked' : ''}} onclick="getOrganization(this.value)" required>
                                                <img src="{{asset('assets/img/user.png')}}" class="thumbnail" style="height: 40px;">Other User
                                            </div>
                                            @if ($errors->has('type'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @else
                                <input type="hidden" name="type" value="1">
                            @endif
                            <div class="form-group row" id="organization" style="display: {{($data->type==0)?'none':''}}">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Organization<span>*</span></label>

                                <div class="col-md-6">
                                    @foreach($organization as $org)
                                        @if(Auth::user()->type==0)
                                            <div class="radio">
                                                <input type="radio" name="organization" id="organization" value="{{$org->id}}" {{($data->organizations_id == $org->id) ? 'checked' : ''}}>
                                                <img src="{{asset('assets/images/org-logo/'.$org->image)}}" class="thumbnail" style="height: 40px;">{{$org->name}}
                                            </div>
                                        @else

                                            <div class="radio">
                                                <input type="radio" name="organization" disabled checked id="organization" value="{{$org->id}}" {{($data->organizations_id == $org->id) ? 'checked' : ''}}>
                                                <img src="{{asset('assets/images/org-logo/'.$org->image)}}" class="thumbnail" style="height: 40px;">{{$org->name}}
                                            </div>
                                        @endif

                                    @endforeach


                                    @if ($errors->has('organization'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('organization') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="designation" class="col-md-4 col-form-label text-md-right">Designation</label>

                                <div class="col-md-6">
                                    <input id="designation" type="text" class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}" name="designation" value="{{ $data->designation }}">

                                    @if ($errors->has('designation'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('designation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @if(Auth::user()->type!=0)
                                <div class="form-group row" id="department">
                                    <label for="department" class="col-md-4 col-form-label text-md-right">Department</label>

                                    <div class="col-md-6">
                                        <select name="department" required class="form-control">
                                            <option>Select Department</option>
                                            <option value="all" {{($data->department_id==null)?'selected':''}}><strong>Access All Department</strong></option>
                                            @if(count($department)>0)
                                                @foreach($department as $dep_data)
                                                    <option value="{{$dep_data->id}}" {{($data->department_id==$dep_data->id)?'selected':''}}>{{$dep_data->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                        @if ($errors->has('department'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row">
                                <label for="contact" class="col-md-4 col-form-label text-md-right">Contact<span>*</span></label>

                                <div class="col-md-6">
                                    <input id="contact" type="number" class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}" name="contact" value="{{ $data->contact }}" required>

                                    @if ($errors->has('contact'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row" id="role" style="display: {{($data->type==0)?'none':''}}">
                                <label for="contact" class="col-md-4 col-form-label text-md-right">User Role<span>*</span></label>

                                <div class="col-md-6">
                                    @if(Auth::user()->type!=0)
                                    <select name="role" class="form-control"><option value="">Select User Role</option>
                                        @foreach($group as $groupData)
                                            @if(Auth::user()->type==0)
                                                @if($groupData->organizations_id!=null)
                                                <option value="{{$groupData->id}}" {{($data->User_Role->roles_id==$groupData->id)?'selected':''}}><b>{{$groupData->Organization->name}}</b>&nbsp;-> &nbsp;{{$groupData->group}}</option>
                                                @endif
                                            @else
                                                @if($groupData->group!='Super Admin')
                                                    <option value="{{$groupData->id}}" {{($data->User_Role->roles_id==$groupData->id)?'selected':''}}>{{$groupData->group}}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                    </select>
                                    @endif

                                    @if ($errors->has('role'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Profile Picture') }}</label>

                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image">

                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
                            @if($data->image!=null)
                                <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Existing Profile Picture') }}</label>
                                <div class="col-md-6">
                                    <img src="{{url('assets/images/user-img/'.$data->image)}}" style="height: 100px;">
                                </div>
                            </div>
                            @endif

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
