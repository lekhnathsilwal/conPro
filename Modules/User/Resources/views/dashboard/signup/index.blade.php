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

                    <div class="card-header">{{ __('Register User') }}</div>
                    <form method="POST" action="{{ route('user.register') }}" enctype="multipart/form-data">
                        @csrf
                    <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name<span>*</span></label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

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
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

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
                                        <input type="radio" name="type"  value="0" {{(old('type') == 0) ? 'checked' : ''}} onclick="getOrganization(this.value)" required>
                                        <img src="{{asset('assets/img/superadmin.png')}}" class="thumbnail" style="height: 40px;">Super Admin
                                    </div>
                                        <div class="radio" style="float: right;">
                                            <input type="radio" name="type"  value="1" {{(old('type') == 1) ? 'checked' : ''}} onclick="getOrganization(this.value)" required>
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
                        <div class="form-group row" id="organization">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Organization<span>*</span></label>

                            <div class="col-md-6">
                                @foreach($organization as $org)
                                    @if(Auth::user()->type==0)
                                    <div class="radio">
                                                <input type="radio" name="organization" id="organization" value="{{$org->id}}" {{(old('organization') == $org->id) ? 'checked' : ''}}>
                                        <img src="{{asset('assets/images/org-logo/'.$org->image)}}" class="thumbnail" style="height: 40px;">{{$org->name}}
                                            </div>
                                    @else

                                        <div class="radio">
                                            <input type="radio" name="organization" disabled checked id="organization" value="{{$org->id}}" {{(old('organization') == $org->id) ? 'checked' : ''}}>
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
                                    <input id="designation" type="text" class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}" name="designation" value="{{ old('designation') }}">

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
                                    <option value="all"><strong>Access All Department</strong></option>
                                    @if(count($department)>0)
                                        @foreach($department as $dep_data)
                                            <option value="{{$dep_data->id}}">{{$dep_data->name}}</option>
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
                        @else
                            <input type="hidden" name="department" value="all">
                            @endif

                            <div class="form-group row">
                                <label for="contact" class="col-md-4 col-form-label text-md-right">Contact<span>*</span></label>

                                <div class="col-md-6">
                                    <input id="contact" type="number" class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}" name="contact" value="{{ old('contact') }}" required>

                                    @if ($errors->has('contact'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        <div class="form-group row" id="role">
                            <label for="contact" class="col-md-4 col-form-label text-md-right">User Group<span>*</span></label>

                            <div class="col-md-6">

                                <select name="role" class="form-control"><option value="">Select User Role</option>
                                    @foreach($group as $groupData)
                                        @if($groupData->group!='Super Admin')
                                    <option value="{{$groupData->id}}">{{$groupData->group}}</option>
                                        @endif
                                    @endforeach
                                </select>

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

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
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
