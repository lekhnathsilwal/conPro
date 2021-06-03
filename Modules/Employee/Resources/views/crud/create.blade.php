@extends('user::dashboard.layout.master')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @include('common.flash')

                    <div class="card-header">{{ __('Register Employee') }}</div>
                    <form method="POST" action="{{ route('employee.register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name<span>*</span></label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Enter Name(eg:Andrew Boston)" name="name" value="{{ old('name') }}" required autofocus>

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
                                    <input id="email" type="email" placeholder="eg:example@gmail.com" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="dob" class="col-md-4 col-form-label text-md-right">Date of Birth</label>

                                <div class="col-md-6">
                                    <input id="dob" type="date" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" value="{{ old('dob') }}">

                                    @if ($errors->has('dob'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="gender" class="col-md-4 col-form-label text-md-right">Gender<span>*</span></label>

                                <div class="col-md-6">
                                    <input type="radio" value="0" name="gender">&nbsp;Male
                                    <input type="radio" value="1"  name="gender">&nbsp;Female
                                    <input type="radio" value="2" name="gender">&nbsp;Other

                                    <br><small>Please select gender of employee</small>

                                    @if ($errors->has('gender'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="contact" class="col-md-4 col-form-label text-md-right">Contact<span>*</span></label>

                                <div class="col-md-6">
                                    <input id="contact" type="number" placeholder="Enter Phone Number" class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}" name="contact" value="{{ old('contact') }}" required>

                                    @if ($errors->has('contact'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">Address<span>*</span></label>

                                <div class="col-md-6">
                                    <textarea id="address" placeholder="Enter Full Current Address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" required cols="10" rows="5">{{ old('address') }}</textarea>

                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row" id="department">
                                <label for="department" class="col-md-4 col-form-label text-md-right">Department</label>

                                <div class="col-md-6">
                                    <select name="department" required class="form-control">
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

                             <div class="form-group row">
                                <label for="designation" class="col-md-4 col-form-label text-md-right">Designation</label>

                                <div class="col-md-6">
                                    <input id="designation" type="text" placeholder="Enter Designation(eg:Manager)" class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}" name="designation" value="{{ old('designation') }}">

                                    @if ($errors->has('designation'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('designation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="joined" class="col-md-4 col-form-label text-md-right">Joined Date</label>

                                <div class="col-md-6">
                                    <input id="joined" type="date" class="form-control{{ $errors->has('joined') ? ' is-invalid' : '' }}" name="joined" value="{{ old('joined') }}">


                                @if ($errors->has('joined'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('joined') }}</strong>
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
