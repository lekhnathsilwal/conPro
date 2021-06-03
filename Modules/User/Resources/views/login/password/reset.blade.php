@extends('user::login.layout.master')
@section('content')
    <div class="container">
        @include('common.flash')
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"><img style="margin-left: 50px;" src="{{url('assets/img/forget_password.gif')}}"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Hi, {{$data->name}}</h1>
                                        <p class="mb-4">You can reset your password now ! Enter new password and confirm password</p>
                                    </div>
                                    <form class="user" action="{{route('user.password.update',['id'=>$data->id])}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Enter New Password"  required>

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                            @endif
                                            <br>
                                            <input id="password_confirmation" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" placeholder="Enter Confirm Password"  required>

                                            @if ($errors->has('password_confirmation'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Update Password"><br><br>
                                        <a href="{{route('user.home')}}" class="btn btn-primary btn-user btn-block">Login Panel</a>

                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
