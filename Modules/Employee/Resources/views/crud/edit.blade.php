@extends('user::dashboard.layout.master')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @include('common.flash')

                    <div class="card-header">{{ __('Edit Employee') }}</div>
                    <form method="POST" action="{{ route('employee.edit',['id'=>$data->id]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name<span>*</span></label>

                                <div class="col-md-6">
                                    <input id="name" type="text" placeholder="Enter Name(eg:Andrew Boston)" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $data->name }}" required autofocus>

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
                                    <input id="email" type="email" placeholder="eg:example@gmail.com" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $data->email }}" required>

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
                                    <input id="dob" type="date" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" value="{{ $data->dob }}">

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
                                    <input type="radio" value="0" name="gender" {{($data->gender==0)?'checked':''}}>&nbsp;Male
                                    <input type="radio" value="1"  name="gender" {{($data->gender==1)?'checked':''}}>&nbsp;Female
                                    <input type="radio" value="2" name="gender" {{($data->gender==2)?'checked':''}}>&nbsp;Other
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
                                    <input id="contact" type="number" placeholder="Enter Phone Number" class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}" name="contact" value="{{ $data->contact}}" required>

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
                                    <textarea id="address" placeholder="Enter Full Current Address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" required cols="10" rows="5">{{$data->address}}</textarea>

                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="department" class="col-md-4 col-form-label text-md-right">Department</label>
                                <div class="col-md-6">
                                    <select name="department" id="department" class="form-control{{ $errors->has('department') ? ' is-invalid' : '' }}" required="required">
                                        <option value="all" {{($data->departments_id==null)?'selected':''}}>Access All Department</option>
                                        @if(count($department)>0)
                                            @foreach($department as $dep_data)
                                                <option value="{{$dep_data->id}}" {{($data->departments_id==$dep_data->id)?'selected':''}}>{{$dep_data->name}}</option>
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
                                    <input id="designation" placeholder="Enter Designation(eg:Manager)" type="text" class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}" name="designation" value="{{ $data->designation }}">

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
                                    <input id="joined" type="date" class="form-control{{ $errors->has('joined') ? ' is-invalid' : '' }}" name="joined" value="{{ $data->joined_date }}">


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
                            @if($data->image!=null)
                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Existing Profile Picture') }}</label>

                                <div class="col-md-6">

                                    <img src="{{asset('assets/img/profile-photos/'.$data->image)}}" style="height: 150px;"/>
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
